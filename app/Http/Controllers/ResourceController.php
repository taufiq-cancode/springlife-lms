<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Resource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ResourceController extends Controller
{
    public function index(){
        try{

            $resources = Resource::all();
            return view('resources.index', compact('resources'));

        }catch (\Exception $e){

            Log::error('Error while retrieving resources : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while retrieving resources');

        }   
    }

    public function download($resourceId){
        try{

            $resource = Resource::findOrFail($resourceId);

            $filePathsJson = $resource->files[0] ?? null;

            if (!$filePathsJson) {
                abort(404, 'File not found');
            }

            $filePaths = json_decode($filePathsJson, true);

            if (!$filePaths || !is_array($filePaths) || empty($filePaths)) {
                abort(404, 'File not found');
            }

            $filePath = $filePaths[0];

            if (!$filePath || !Storage::exists($filePath)) {
                abort(404, 'File not found');
            }

            return response()->download(Storage::path($filePath));

        }catch(\Exception $e){

            Log::error('Error while downloading resource : '. $e->getMessage());
            return redirect()->back()->with('error', 'Error while downloading resource');

        }

        
    }
}
