@extends('layout.console')

<!-- These forms are dynamically rendered by the contents of the 'segment_fields' table, as defined by their
segment_type_id -->

@section('content')
<section class="w3-padding form-container">

    <h2>Segment Type</h2>

    <div class="segment-choice">
        <a href="{{ route('segment_forms.add', ['segment_type_id' => 1]) }}">Report</a>
        <br>
        <a href="{{ route('segment_forms.add', ['segment_type_id' => 2]) }}">Joke</a>
        <br>
        <a href="{{ route('segment_forms.add', ['segment_type_id' => 3]) }}">Game</a>
    </div>
  
    @if (isset($segmentFields))
        @php
            $typeName = '';

            if ($segment_type_id == 1) {
                $typeName = 'ADD REPORT';
            } elseif ($segment_type_id == 2) {
                $typeName = 'ADD JOKE';
            } elseif ($segment_type_id == 3) {
                $typeName = 'ADD GAME';
            }
        @endphp
        <h3 class="med-titles">{{ $typeName }}</h3>
        <form method="post" action="{{ route('segment_forms.store') }}" novalidate>
            @csrf

            <div class="form-row">
                @foreach ($segmentFields as $segmentField)
                    @if ($segmentField->segment_type_id == $segment_type_id)
                        @if (preg_match('/^title$/i', $segmentField->field_name))
                            <div class="form-group">
                                <label class="form-labels">{{ $segmentField->field_label }}</label>
                                <input type="text" name="title">
                            </div>
                        @else
                            <div class="form-group">
                                <label class="form-labels">{{ $segmentField->field_label }}</label>
                                <div>
                                    @if ($segmentField->field_data_type == "text")
                                        <input type="text" name="segment_data[{{ $segmentField->field_name }}]">
                                    @elseif ($segmentField->field_data_type == "textarea")
                                        <textarea name="segment_data[{{ $segmentField->field_name }}]" id="{{ $segmentField->field_name }}" rows="5" cols="50"></textarea>
                                    @elseif ($segmentField->field_data_type == "checkbox")
                                        <input type="checkbox" name="segment_data[{{ $segmentField->field_name }}]" id="{{ $segmentField->field_name }}" value="1">
                                    @elseif ($segmentField->field_data_type == "radio")
                                        <input type="radio" name="segment_data[{{ $segmentField->field_name }}]" id="{{ $segmentField->field_name }}" value="1">
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>

            @if ($subSegmentTypes->count() > 0)
                <div class="form-group">
                    <label class="form-labels">Sub-Segment</label>
                    <select name="sub_segment_type_id">
                        <option value="">----Select Sub-Segment----</option>
                        @foreach ($subSegmentTypes as $subSegmentType)
                            <option value="{{ $subSegmentType->id }}">{{ $subSegmentType->sub_segment_name }}</option>
                        @endforeach
                    </select>
                </div>

            @endif
    
            <input type="hidden" name="segment_type_id" value="{{ $segment_type_id }}">
            <input type="hidden" name="internal_system_id" value="1">
            <input type="hidden" name="user_id" value="{{ $user_id }}">
       
            <br>

            <button type="submit" class="w3-button w3-green">Add Segment</button>
        </form>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="{{ route('segment_forms.list') }}" class="w3-button orange-background">Back to Segments</a>
</section>
@endsection
