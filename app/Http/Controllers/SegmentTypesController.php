<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SegmentType;

class SegmentTypesController extends Controller
{
    //
    public function list()
    {
        return view('segment_types.list', [
            'segment_types' => SegmentType::all()
        ]);
    }
    
    public function addForm()
    {

        return view('segment_types.add');
    }
        
    public function add()
    {

        $attributes = request()->validate([
            'type_name' => 'required',
        ]);

        $segmentType = new SegmentType();
        $segmentType->type_name = $attributes['type_name'];
        $segmentType->save();

        return redirect('/console/segment_types/list')
            ->with('message', 'Segment Type has been added!');
    }
    
    public function editForm(SegmentType $segmentType)
    {
        return view('segment_types.edit', [
            'segment_type' => $segmentType,
        ]);
    }
    
    public function edit(SegmentType $segmentType)
    {

        $attributes = request()->validate([
            'type_name' => 'required',
        ]);

        $segmentType->type_name = $attributes['type_name'];
        $segmentType->save();

        return redirect('/console/segment_types/list')
            ->with('message', 'Segment Type has been edited!');
    }
    
    public function delete(SegmentType $segmentType)
    {
        $segmentType->delete();
        
        return redirect('/console/segment_types/list')
            ->with('message', 'Segment Type has been deleted!');        
    }
    
}
