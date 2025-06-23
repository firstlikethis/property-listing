<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BtsStation;
use App\Models\District;
use App\Models\Facility;
use App\Models\Type;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('check.admin');
    }

    /**
     * Display a listing of the zones.
     */
    public function zones(Request $request)
    {
        $zones = Zone::withCount('districts')
            ->orderBy('name')
            ->paginate(20);
            
        return view('admin.categories.zones.index', compact('zones'));
    }

    /**
     * Store a newly created zone in storage.
     */
    public function storeZone(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:zones',
        ]);

        Zone::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.zones')
            ->with('success', 'โซนถูกสร้างเรียบร้อยแล้ว');
    }

    /**
     * Update the specified zone in storage.
     */
    public function updateZone(Request $request, Zone $zone)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('zones')->ignore($zone->id),
            ],
        ]);

        $zone->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.zones')
            ->with('success', 'โซนถูกอัปเดตเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified zone from storage.
     */
    public function destroyZone(Zone $zone)
    {
        // ตรวจสอบว่าโซนนี้ไม่มีอำเภอภายใต้
        if ($zone->districts()->count() > 0) {
            return redirect()->route('admin.categories.zones')
                ->with('error', 'ไม่สามารถลบโซนที่มีอำเภอภายใต้ได้');
        }

        $zone->delete();

        return redirect()->route('admin.categories.zones')
            ->with('success', 'โซนถูกลบเรียบร้อยแล้ว');
    }

    /**
     * Display a listing of the districts.
     */
    public function districts(Request $request)
    {
        $districts = District::with('zone')
            ->withCount('posts')
            ->orderBy('name')
            ->paginate(20);
            
        $zones = Zone::orderBy('name')->get();
            
        return view('admin.categories.districts.index', compact('districts', 'zones'));
    }

    /**
     * Store a newly created district in storage.
     */
    public function storeDistrict(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:districts',
            'zone_id' => 'nullable|exists:zones,id',
        ]);

        District::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'zone_id' => $request->zone_id,
        ]);

        return redirect()->route('admin.categories.districts')
            ->with('success', 'อำเภอถูกสร้างเรียบร้อยแล้ว');
    }

    /**
     * Update the specified district in storage.
     */
    public function updateDistrict(Request $request, District $district)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('districts')->ignore($district->id),
            ],
            'zone_id' => 'nullable|exists:zones,id',
        ]);

        $district->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'zone_id' => $request->zone_id,
        ]);

        return redirect()->route('admin.categories.districts')
            ->with('success', 'อำเภอถูกอัปเดตเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified district from storage.
     */
    public function destroyDistrict(District $district)
    {
        // ตรวจสอบว่าอำเภอนี้ไม่มีโพสต์ภายใต้
        if ($district->posts()->count() > 0) {
            return redirect()->route('admin.categories.districts')
                ->with('error', 'ไม่สามารถลบอำเภอที่มีโพสต์ภายใต้ได้');
        }

        $district->delete();

        return redirect()->route('admin.categories.districts')
            ->with('success', 'อำเภอถูกลบเรียบร้อยแล้ว');
    }

    /**
     * Display a listing of the BTS stations.
     */
    public function btsStations(Request $request)
    {
        $btsStations = BtsStation::withCount('posts')
            ->orderBy('line')
            ->orderBy('name')
            ->paginate(20);
            
        return view('admin.categories.bts-stations.index', compact('btsStations'));
    }

    /**
     * Store a newly created BTS station in storage.
     */
    public function storeBtsStation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:bts_stations',
            'line' => 'required|string|max:50',
            'color' => 'nullable|string|max:20',
        ]);

        BtsStation::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'line' => $request->line,
            'color' => $request->color,
        ]);

        return redirect()->route('admin.categories.bts-stations')
            ->with('success', 'สถานีรถไฟฟ้าถูกสร้างเรียบร้อยแล้ว');
    }

    /**
     * Update the specified BTS station in storage.
     */
    public function updateBtsStation(Request $request, BtsStation $btsStation)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('bts_stations')->ignore($btsStation->id),
            ],
            'line' => 'required|string|max:50',
            'color' => 'nullable|string|max:20',
        ]);

        $btsStation->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'line' => $request->line,
            'color' => $request->color,
        ]);

        return redirect()->route('admin.categories.bts-stations')
            ->with('success', 'สถานีรถไฟฟ้าถูกอัปเดตเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified BTS station from storage.
     */
    public function destroyBtsStation(BtsStation $btsStation)
    {
        // ตรวจสอบว่าสถานีนี้ไม่มีโพสต์ภายใต้
        if ($btsStation->posts()->count() > 0) {
            return redirect()->route('admin.categories.bts-stations')
                ->with('error', 'ไม่สามารถลบสถานีรถไฟฟ้าที่มีโพสต์ภายใต้ได้');
        }

        $btsStation->delete();

        return redirect()->route('admin.categories.bts-stations')
            ->with('success', 'สถานีรถไฟฟ้าถูกลบเรียบร้อยแล้ว');
    }

    /**
     * Display a listing of the property types.
     */
    public function types(Request $request)
    {
        $types = Type::withCount('posts')
            ->orderBy('name')
            ->paginate(20);
            
        return view('admin.categories.types.index', compact('types'));
    }

    /**
     * Store a newly created property type in storage.
     */
    public function storeType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:types',
        ]);

        Type::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.types')
            ->with('success', 'ประเภทที่พักถูกสร้างเรียบร้อยแล้ว');
    }

    /**
     * Update the specified property type in storage.
     */
    public function updateType(Request $request, Type $type)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('types')->ignore($type->id),
            ],
        ]);

        $type->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.types')
            ->with('success', 'ประเภทที่พักถูกอัปเดตเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified property type from storage.
     */
    public function destroyType(Type $type)
    {
        // ตรวจสอบว่าประเภทนี้ไม่มีโพสต์ภายใต้
        if ($type->posts()->count() > 0) {
            return redirect()->route('admin.categories.types')
                ->with('error', 'ไม่สามารถลบประเภทที่พักที่มีโพสต์ภายใต้ได้');
        }

        $type->delete();

        return redirect()->route('admin.categories.types')
            ->with('success', 'ประเภทที่พักถูกลบเรียบร้อยแล้ว');
    }

    /**
     * Display a listing of the facilities.
     */
    public function facilities(Request $request)
    {
        $facilities = Facility::withCount('posts')
            ->orderBy('name')
            ->paginate(20);
            
        return view('admin.categories.facilities.index', compact('facilities'));
    }

    /**
     * Store a newly created facility in storage.
     */
    public function storeFacility(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:facilities',
            'icon' => 'nullable|string|max:50',
        ]);

        Facility::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon,
        ]);

        return redirect()->route('admin.categories.facilities')
            ->with('success', 'สิ่งอำนวยความสะดวกถูกสร้างเรียบร้อยแล้ว');
    }

    /**
     * Update the specified facility in storage.
     */
    public function updateFacility(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('facilities')->ignore($facility->id),
            ],
            'icon' => 'nullable|string|max:50',
        ]);

        $facility->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon,
        ]);

        return redirect()->route('admin.categories.facilities')
            ->with('success', 'สิ่งอำนวยความสะดวกถูกอัปเดตเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified facility from storage.
     */
    public function destroyFacility(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('admin.categories.facilities')
            ->with('success', 'สิ่งอำนวยความสะดวกถูกลบเรียบร้อยแล้ว');
    }
}