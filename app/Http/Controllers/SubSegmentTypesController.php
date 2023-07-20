<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SegmentType;
use App\Models\SubSegmentType;

class SubSegmentTypesController extends Controller
{
    public function list()
    {
        return view('sub_segment_types.list', [
            'sub_segment_types' => SubSegmentType::all()
        ]);
     
    }

    public function addForm()
    {
        return view('sub_segment_types.add', [
            'segment_type_id' => SegmentType::all(),
        ]);
    }
    
    public function add()
    {

        $attributes = request()->validate([
            'sub_segment_name' => 'required',
            'segment_type_id' => 'required',
        ]);

        $subSegmentType = new SubSegmentType();
        $subSegmentType->sub_segment_name = $attributes['sub_segment_name'];
        $subSegmentType->segment_type_id = $attributes['segment_type_id'];
        $subSegmentType->save();

        return redirect('/console/sub_segment_types/list')
            ->with('message', 'Sub-Segment Type has been added!');
    }

    public function editForm(SubSegmentType $subSegmentType)
    {
        return view('sub_segment_types.edit', [
            'sub_segment_type' => $subSegmentType,
            'segment_type_id' => SegmentType::all(),
        ]);
    }

    public function edit(SubSegmentType $subSegmentType)
    {

        $attributes = request()->validate([
            'sub_segment_name' => 'required',
            'segment_type_id' => 'required',
        ]);

        $subSegmentType->sub_segment_name = $attributes['sub_segment_name'];
        $subSegmentType->segment_type_id = $attributes['segment_type_id'];
 
        $subSegmentType->save();

        return redirect('/console/sub_segment_types/list')
            ->with('message', 'Sub-Segment Field has been edited!');
    }

    public function delete(SubSegmentType $subSegmentType)
    {
        
        $subSegmentType->delete();
        
        return redirect('/console/sub_segment_types/list')
            ->with('message', 'Sub-Segment Type has been deleted!');        
    }

}
