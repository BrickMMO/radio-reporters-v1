<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\SegmentType;
use App\Models\SegmentField;
use App\Models\SubSegmentType;
use App\Models\User;
use App\Models\InternalSystem;
use App\Models\Segment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 

/* This is the real meat for editing segments 
* forms are dynamically rendered based on criteria from form fields table 
* some fields are saved as json to be stored in segment_data for producer to easily
parse for openai prompts */

// <!-- These forms are dynamically rendered by the contents of the 'segment_fields' table, as defined by their
// segment_type_id -->

class SegmentFormController extends Controller
{
    public function list()
    {
        $segments = Segment::paginate(8)->withQueryString();
        return view('segment_forms.list', [
            'segments' => $segments
        ]);
    }

    public function addForm(Request $request)
    {
        $segment_type_id = $request->query('segment_type_id');
        $segmentFields = SegmentField::all();
        $segmentTypes = SegmentType::all();
        $subSegmentTypes = SubSegmentType::where('segment_type_id', $segment_type_id)->get();
        $user_id = Auth::user()->id;
        $user_role = Auth::user()->role;
        return view('segment_forms.add', compact('segment_type_id', 'segmentFields', 'subSegmentTypes', 'user_id', 'user_role', 'segmentTypes'));
    }
    

    public function store(Request $request)
    {
        // Obtain the user ID
        $user_id = Auth::user()->id;
        $user_role = Auth::user()->role;
        $segment_type_id = $request->query('segment_type_id');
    
        // Merge the user_id with the form data
        $attributes = array_merge($request->all(), ['user_id' => $user_id, 'segment_type_id' => $segment_type_id]);
    
        // Validate the form data
        $validatedData = request()->validate([
            'title' => 'required',
            'segment_data' => 'required',
            'segment_type_id' => 'required',
            'internal_system_id' => 'required',
            'sub_segment_type_id' => 'required',
        ]);
    
        // Retrieve the sub_segment_type
        $subSegmentType = SubSegmentType::findOrFail($validatedData['sub_segment_type_id']);
    
        // Create a new segment instance
        $segment = new Segment();
    
        // Assign the form data to the segment model
        $segment->title = $validatedData['title'];
    
        $segmentData = [];
    
        foreach ($request->all() as $fieldName => $fieldValue) {
            if ($fieldName === 'segment_data') {
                $segmentData = $fieldValue; // Assign the segment_data directly
            }
        }
    
        $segmentData['sub_segment_name'] = $subSegmentType->sub_segment_name;
    
        $segment->segment_data = json_encode($segmentData);
    
        $segment->segment_type_id = $validatedData['segment_type_id'];
        $segment->internal_system_id = 1;
        $segment->user_id = $user_id;
    
        // Save the segment
        $segment->save();
    
        // Redirect to the segment list page
        return redirect()->route('segment_forms.list');
    }

    public function editForm(Segment $segment)
    {
        $segment_type_id = $segment->segment_type_id;
        $segmentFields = SegmentField::all();
        $subSegmentTypes = SubSegmentType::where('segment_type_id', $segment_type_id)->get();
        $user_id = Auth::user()->id;
        $user_role = Auth::user()->role;
    
        return view('segment_forms.edit', compact('segment', 'segment_type_id', 'segmentFields', 'subSegmentTypes', 'user_id'));
    }
    public function edit(Request $request, $segmentId)
    {
        // Retrieve the segment by ID
        $segment = Segment::find($segmentId);
    
        if (!$segment) {
            // Handle the case when the segment is not found
            return redirect()->back()->with('error', 'Segment not found');
        }
    
        // Validate the form data
        $validatedData = $request->validate([
            'custom_title' => 'required',
            'segment_type_id' => 'required',
            'internal_system_id' => 'required',
            'sub_segment_type_id' => 'required',
            'segment_data' => 'required',
        ], [
            'custom_title.required' => 'The title field is required.',
            'segment_data.required' => 'The segment data field is required.',
        ]);
    
        // Retrieve the existing segment_data
        $segmentData = $segment->segment_data ? json_decode($segment->segment_data, true) : [];
    
        // Update the dynamic fields in the segment_data array
        foreach ($request->segment_data as $fieldName => $fieldValue) {
            $segmentData[$fieldName] = $fieldValue;
        }
    
        // Retrieve the sub_segment_name
        $subSegmentType = SubSegmentType::find($request->input('sub_segment_type_id'));
        $subSegmentName = $subSegmentType ? $subSegmentType->sub_segment_name : null;
    
        // Update segment_data with sub_segment_name
        $segmentData['sub_segment_name'] = $subSegmentName;
    
        // Update the segment model with the new data
        $segment->title = $validatedData['custom_title'];
        $segment->user_id = Auth::user()->id;
        $segment->segment_data = json_encode($segmentData);
    
        // Save the segment
        $segment->save();
    
        // Redirect back with success message
        return redirect('/console/segment_forms/list')->with('message', 'Segment has been edited!');
    }

    public function imageForm(Segment $segment)
    {
        return view('segment_forms.image', [
            'segment' => $segment,
        ]);
    }

    public function image(Segment $segment)
    {

        $attributes = request()->validate([
            'image' => 'required|image',
        ]);

        if($segment->image)
        {
            Storage::delete($segment->image);
        }
        
        $path = request()->file('image')->store('segments');

        $segment->image = $path;
        $segment->save();
        
        return redirect('/console/segment_forms/list')
            ->with('message', 'Segment image has been edited!');
    }

    public function delete(Segment $segment)
    {

        if($segment->image)
        {
            Storage::delete($segment->image);
        }
        
        $segment->delete();
        
        return redirect('/console/segment_forms/list')
            ->with('message', 'segment has been deleted!');        
    }    
    
}
