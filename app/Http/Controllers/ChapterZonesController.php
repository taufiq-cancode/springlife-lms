<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Zone;
use Illuminate\Http\Request;

class ChapterZonesController extends Controller
{
    public function index()
    {         
        $chapters = Chapter::all();  
        $zones = Zone::all();
         
        return view('chapter-zones', compact('chapters', 'zones'));    
    }

    public function storeChapter(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        Chapter::create($request->all());
    
        return redirect()->back()->with('success', 'Chapter created successfully.');
    }

    public function storeZone(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        Zone::create($request->all());
    
        return redirect()->back()->with('success', 'Zone created successfully.');
    }

    public function updateChapter(Request $request, $chapterId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $chapter = Chapter::findOrFail($chapterId);
        $chapter->update($request->all());

        return redirect()->back()->with('success', 'Chapter updated successfully.');
    }

    public function updateZone(Request $request, $zoneId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $zone = Zone::findOrFail($zoneId);
        $zone->update($request->all());

        return redirect()->back()->with('success', 'Zone updated successfully.');
    }

    public function destroyChapter($chapterId)
    {
        $chapter = Chapter::findOrFail($chapterId);
        $chapter->delete();

        return redirect()->back()->with('success', 'Chapter deleted successfully.');
    }

    public function destroyZone($zoneId)
    {
        $zone = Zone::findOrFail($zoneId);
        $zone->delete();

        return redirect()->back()->with('success', 'Zone deleted successfully.');
    }
}
