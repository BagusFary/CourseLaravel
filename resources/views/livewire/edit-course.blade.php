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
</div>
