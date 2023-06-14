@extends('layouts.dashboard')

@section('content')

<div class="container">
    {{ $dataTag }}
    <h2 class="d-flex justify-content-center">Edit Course</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="d-flex justify-content-center mt-3">
        <div class="card" style="width: 18rem;">
            {{-- <img src="{{ asset('storage/thumbnail/'.$dataCourse->thumbnail) }}" class="card-img-top" alt="..."> --}}
            <video src="{{ asset('storage/video/'. $dataCourse->video) }}" class="card-img-top" controlsList="nodownload" oncontextmenu="return false;" muted autoplay loop></video>
            <div class="card-body">
              <h5 class="card-title">{{ $dataCourse->title }}</h5>
              @foreach ($dataCourse->tags as $tag)
                <a href="/course?keyword={{ $tag->name_tags }}"><span class="badge text-bg-secondary">{{ $tag->name_tags }}</span></a>
              @endforeach
              <p class="card-text">{{ $dataCourse->description }}</p>
              <p>Rp.{{ number_format($dataCourse->price,2,',','.'); }}</p>
              <a href="#" class="btn btn-success disabled">Course Detail</a>
            </div>
          </div>
          <form action="/update-course/{{ $dataCourse->id }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
                <div class="mb-2 mx-3">
                    <label for="title" class="form-label">Course Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="{{ $dataCourse->title }}" value="{{ $dataCourse->title }}">
                </div>
                    <div class="mx-3">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="10" rows="5" placeholder="{{ $dataCourse->description }}" value="{{ $dataCourse->description }}">{{ $dataCourse->description }}</textarea>
                    </div>
                <div class="mb-3 mx-3">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control" id="thumbnail">
                </div>
                <div class="mb-3 mx-3">
                    <label for="video">Video</label>
                    <input type="file" name="video" class="form-control" id="video">
                </div>
                <div class="mb-3 mx-3">
                    <label for="price">Price</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Rp.</span>
                        <input type="number" name="price" class="form-control" placeholder="Price" value="{{ $dataCourse->price }}" required>
                    </div>
                </div>
                <div class="mb-3 mx-3">
                    <label for="tag">Tags<label>
                        <div class="input-group mb-3">

                        <input type="text" name="tag" class="form-control" placeholder="Tags" value="" required>

                    </div>
                </div>
                <div class="mb-3 mx-3">
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="/show-all-courses" class="btn btn-warning">Back/Cancel</a>
                    <a href="/delete-course/{{ $dataCourse->id }}" class="btn btn-outline-danger">Delete</a>
                </div>
            </form>
    </div>
       
</div>
    
@endsection 