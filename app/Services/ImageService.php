<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageIntervention;

class ImageService
{
    /**
     * Upload and save images for a post.
     *
     * @param Post $post
     * @param array $images
     * @param bool $setPrimary
     * @return void
     */
    public function uploadPostImages(Post $post, array $images, bool $setPrimary = true)
    {
        $lastOrder = $post->images()->max('order') ?? 0;
        $isPrimarySet = !$setPrimary;

        foreach ($images as $index => $image) {
            $path = $this->uploadImage($image, 'posts');
            
            $postImage = new Image();
            $postImage->path = $path;
            $postImage->order = $lastOrder + $index + 1;
            
            // ตั้งรูปแรกเป็นรูปหลัก
            if (!$isPrimarySet) {
                $postImage->is_primary = true;
                $isPrimarySet = true;
            } else {
                $postImage->is_primary = false;
            }
            
            $post->images()->save($postImage);
        }
    }

    /**
     * Set the primary image for a post.
     *
     * @param Post $post
     * @param int $imageId
     * @return bool
     */
    public function setPrimaryImage(Post $post, int $imageId)
    {
        $image = $post->images()->find($imageId);
        
        if (!$image) {
            return false;
        }
        
        $post->images()->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);
        
        return true;
    }

    /**
     * Delete images for a post.
     *
     * @param Post $post
     * @param array $imageIds
     * @return int
     */
    public function deletePostImages(Post $post, array $imageIds)
    {
        $images = $post->images()->whereIn('id', $imageIds)->get();
        $count = 0;
        
        foreach ($images as $image) {
            Storage::delete($image->path);
            $image->delete();
            $count++;
        }
        
        // หากลบรูปหลัก ให้ตั้งรูปแรกที่เหลือเป็นรูปหลัก
        if ($post->images()->where('is_primary', true)->count() === 0 && $post->images()->count() > 0) {
            $post->images()->first()->update(['is_primary' => true]);
        }
        
        return $count;
    }

    /**
     * Upload an image and return the path.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param int $width
     * @param int $height
     * @return string
     */
    public function uploadImage(UploadedFile $file, string $folder, int $width = 1200, int $height = null)
    {
        $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = "public/images/{$folder}/{$filename}";
        
        // เก็บไฟล์ต้นฉบับ
        $file->storeAs("public/images/{$folder}", $filename);
        
        // ปรับขนาดรูปภาพ (ถ้าต้องการ)
        if ($width) {
            $img = ImageIntervention::make(storage_path("app/{$path}"));
            
            if ($height) {
                $img->fit($width, $height);
            } else {
                $img->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }
            
            $img->save();
        }
        
        return $path;
    }

    /**
     * Create a thumbnail from an image.
     *
     * @param string $imagePath
     * @param int $width
     * @param int $height
     * @return string
     */
    public function createThumbnail(string $imagePath, int $width = 300, int $height = 200)
    {
        $pathInfo = pathinfo($imagePath);
        $thumbnailPath = str_replace(
            $pathInfo['basename'],
            "thumb_{$width}x{$height}_{$pathInfo['basename']}",
            $imagePath
        );
        
        $img = ImageIntervention::make(storage_path("app/{$imagePath}"));
        $img->fit($width, $height);
        $img->save(storage_path("app/{$thumbnailPath}"));
        
        return $thumbnailPath;
    }
}