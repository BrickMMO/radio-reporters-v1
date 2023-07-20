<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SegmentField;
use App\Models\SegmentType;

class SegmentFieldsController extends Controller
{
    public function list()
    {
        return view('segment_fields.list', [
            'segment_fields' => SegmentField::all(),
        ]);
     
    }

    public function addForm()
    {
        return view('segment_fields.add', [
            'segment_type_id' => SegmentType::all(),
        ]);
    }
    
    public function add()
    {

        $attributes = request()->validate([
            'field_name' => 'required',
            'field_label' => 'required',
            'field_data_type' => 'required',
            'segment_type_id' => 'required',
            // 'type_name' => 'nullable',
        ]);

        $segmentField = new SegmentField();
        $segmentField->field_name = $attributes['field_name'];
        $segmentField->field_label = $attributes['field_label'];
        $segmentField->field_data_type = $attributes['field_data_type'];
        $segmentField->segment_type_id = $attributes['segment_type_id'];
        // $segmentField->type_name = $attributes['type_name'];
        // $project->user_id = Auth::user()->id;
        $segmentField->save();

        return redirect('/console/segment_fields/list')
            ->with('message', 'Segment Field has been added!');
    }

    public function editForm(SegmentField $segmentField)
    {
        return view('segment_fields.edit', [
            'segment_field' => $segmentField,
            'segment_type' => SegmentType::all(),
        ]);
    }

    public function edit(SegmentField $segmentField)
    {
        $attributes = request()->validate([
            'field_name' => 'required',
            'field_label' => 'required',
            'field_data_type' => 'required',
            'segment_type_id' => 'required',
        ]);

        $segmentField->field_name = $attributes['field_name'];
        $segmentField->field_label = $attributes['field_label'];
        $segmentField->field_data_type = $attributes['field_data_type'];
        $segmentField->segment_type_id = $attributes['segment_type_id'];
        $segmentField->save();

        return redirect('/console/segment_fields/list')
            ->with('message', 'Segment Field has been edited!');
    }

    public function delete(SegmentField $segmentField)
    {
        
        $segmentField->delete();
        
        return redirect('/console/segment_fields/list')
            ->with('message', 'Segment Field has been deleted!');        
    }

   
}
