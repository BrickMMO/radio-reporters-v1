@extends ('layout.console')

@section ('content')

<!-- these views arent in use, see segment_forms -->

<section class="w3-padding form-container">

    <h2>Segment Image</h2>

    <div class="w3-margin-bottom">
        @if($segment->image)
            <img src="{{asset('storage/'.$segment->image)}}" width="200">
        @endif
    </div>

    <form method="post" action="/console/segments/image/{{$segment->id}}" novalidate class="w3-margin-bottom" enctype="multipart/form-data">

        @csrf

        <div class="w3-margin-bottom">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" value="{{old('image')}}" required>
            
            @if ($errors->first('image'))
                <br>
                <span class="w3-text-red">{{$errors->first('image')}}</span>
            @endif
        </div>

        <button type="submit" class="w3-button w3-green">Add Image</button>

    </form>

    <a href="/console/segments/list">Back to Segment List</a>

</section>

@endsection
