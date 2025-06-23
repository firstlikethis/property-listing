<?php

namespace App\Http\Controllers;

use App\Models\BtsStation;
use App\Models\District;
use App\Models\Facility;
use App\Models\Post;
use App\Models\Type;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with(['images', 'type', 'district', 'btsStation'])
            ->published()
            ->notExpired();

        // Filter by search term
        if ($request->filled('q')) {
            $searchTerm = $request->input('q');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('description', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('address', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('building', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Filter by district
        if ($request->filled('district_id')) {
            $query->where('district_id', $request->input('district_id'));
        }

        // Filter by BTS station
        if ($request->filled('bts_station_id')) {
            $query->where('bts_station_id', $request->input('bts_station_id'));
        }

        // Filter by property type
        if ($request->filled('type_id')) {
            $query->where('type_id', $request->input('type_id'));
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        // Filter by bedrooms
        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', '>=', $request->input('bedrooms'));
        }

        // Filter by bathrooms
        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', '>=', $request->input('bathrooms'));
        }

        // Filter by facilities
        if ($request->filled('facilities')) {
            $facilities = $request->input('facilities');
            foreach ($facilities as $facility) {
                $query->whereHas('facilities', function ($q) use ($facility) {
                    $q->where('facilities.id', $facility);
                });
            }
        }

        // Sort results
        $sortBy = $request->input('sort', 'latest');
        switch ($sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            default:
                $query->latest();
                break;
        }

        $posts = $query->paginate(15)->withQueryString();

        // Get filters for dropdowns
        $districts = District::orderBy('name')->get();
        $btsStations = BtsStation::orderBy('name')->get();
        $types = Type::orderBy('name')->get();
        $facilities = Facility::orderBy('name')->get();

        return view('search.index', compact(
            'posts',
            'districts',
            'btsStations',
            'types',
            'facilities'
        ));
    }
}