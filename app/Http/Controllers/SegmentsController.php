<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\SegmentType;
use App\Models\InternalSystem;
use App\Models\Segment;


/* see segmentForm controller for most functionality regarding the dynamic form rendering
this is/was more for admin originally, offering ability to edit internal_system, subsegment_id, and user_id
which doesnt really have much usecase */

class SegmentsController extends Controller
{
    public function list()
    {
        $segments = Segment::paginate(8)->withQueryString();
        return view('segments.list', [
            'segments' => $segments
        ]);
    }
    

    public function addForm()
    {
        return view('segments.add', [
            'segment_type_id' => SegmentType::all(),
            'user_id' => User::all(),
            'internal_system_id' => InternalSystem::all(),
        ]);
    }
    
    public function add()
    {

        $attributes = request()->validate([
            'title' => 'required',
            'segment_data' => 'required',
            'segment_type_id' => 'required',
            'internal_system_id' => 'required',
            'user_id' => 'required',
        ]);

        $segment = new Segment();
        $segment->title = $attributes['title'];
        $segment->segment_data = $attributes['segment_data'];
        $segment->segment_type_id = $attributes['segment_type_id'];
        $segment->internal_system_id = $attributes['internal_system_id'];
        $segment->user_id = Auth::user()->id;
        $segment->save();

        return redirect('/console/segments/list')
            ->with('message', 'segment has been added!');
    }


        public function editForm(Segment $segment)
    {
        $segmentTypes = SegmentType::all();
        $users = User::all();
        $internalSystems = InternalSystem::all();

        return view('segments.edit', compact('segment', 'segmentTypes', 'users', 'internalSystems'));
    }


    public function edit(Segment $segment)
    {

        $segment_type_id = $segment->segment_type_id;

        $attributes = request()->validate([
            'title' => 'required',
            'segment_data' => 'required',
            'segment_type_id' => 'required',
            'internal_system_id' => 'required',
            'user_id' => 'required',
        ]);

        
        $segment->title = $attributes['title'];
        $segment->segment_data = $attributes['segment_data'];
        $segment->segment_type_id = $attributes['segment_type_id'];
        $segment->internal_system_id = $attributes['internal_system_id'];
        $segment->user_id = $attributes['user_id'];
        $segment->save();

        return redirect('/console/segments/list')
            ->with('message', 'Segment has been edited!');
    }

    public function delete(Segment $segment)
    {

        if($segment->image)
        {
            Storage::delete($segment->image);
        }
        
        $segment->delete();
        
        return redirect('/console/segments/list')
            ->with('message', 'segment has been deleted!');        
    }

    public function imageForm(Segment $segment)
    {
        return view('segments.image', [
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
        
        return redirect('/console/segments/list')
            ->with('message', 'Segment image has been edited!');
    }
    
}
