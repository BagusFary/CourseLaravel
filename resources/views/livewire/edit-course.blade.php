<div>
    <div class="d-flex justify-content-center mt-3">
        <div class="card" style="width: 18rem;">
            <video src="{{ asset('storage/video/'. $video) }}" class="card-img-top" controlsList="nodownload" oncontextmenu="return false;" muted autoplay loop></video>
            <div class="card-body">
                <h5 class="card-title">{{ $title }}</h5>
                @foreach ($tags as $tag)
                <a href="/course?keyword={{ $tag->name_tags }}"><span class="badge text-bg-secondary">{{ $tag->name_tags }}</span></a>
                @endforeach
                <p class="card-text">{{ $description }}</p>
                <p>Rp.{{ number_format($price,2,',','.'); }}</p>
                <a href="#" class="btn btn-success disabled">Course Detail</a>
            </div>
        </div>
        
        <form action="/update-course/{{ $courseID }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
                <div class="mb-2 mx-3">
                    <label for="title" class="form-label">Course Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="{{ $title }}" value="{{ $title }}" wire:model="title">
                </div>
                    <div class="mx-3">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" cols="10" rows="5" placeholder="{{ $description }}" value="{{ $description }}" wire:model="description">{{ $description }}</textarea>
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
                        <input type="number" name="price" class="form-control" placeholder="Price" value="{{ $price }}" wire:model="price" required>
                    </div>
                </div>
                <div class="mb-3 mx-3">
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="/show-all-courses" class="btn btn-warning">Back/Cancel</a>
                    <a href="/delete-course/{{ $courseID }}" class="btn btn-outline-danger">Delete</a>
                </div>
            </form>
</div>