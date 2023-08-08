<div>

    <div class="container">
        @if (Auth::check())
        <div class="d-flex justify-content-center">
            <div class="col-md-4">
                <form action="" method="get" class="d-flex" role="search">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Find here..." aria-describedby="basic-addon1" wire:model.debounce.450ms="search">
                      </div>
                </form>
            </div>
        </div>
        <div class="mb-2 d-flex justify-content-end">
            {{ $dataCourse->links() }}
        </div>
        @endif
            <div wire:loading wire:loading.class="d-flex justify-content-center my-5">
                <div class="la-cube-transition la-dark la-3x">
                    <div></div>
                    <div></div>
                </div>
            </div>
        <div wire:loading.remove>
            <div class="row">
                @forelse ($dataCourse as $item)
                   <div class="col-md-4 mb-5 mt-3 d-flex justify-content-center">
                       <div class="card" style="width: 18rem;">
                           <img src="{{ asset('storage/thumbnail/'.$item->thumbnail) }}" class="card-img-top" alt="...">
                           <div class="card-body">
                             <h5 class="card-title">{{ $item->title }}</h5>
                               @foreach ($item->tags as $tag)
                                    <a href="/course?keyword={{ $tag->name_tags }}"><span class="badge text-bg-secondary">{{ $tag->name_tags }}</span></a>
                               @endforeach
                             <p class="card-text">{{ $item->description }}</p>
                             <p>Rp.{{ number_format($item->price,2,',','.'); }}</p>
                             <a href="/detail-course/{{ $item->id }}" class="btn btn-outline-dark">Course Detail</a>
                           </div>
                       </div>
                   </div>
                   @empty
                   <div class="d-flex justify-content-center">
                       <div class="mt-5">
                           <h2>No Course Found :(</h2>
                           <div class="la-pacman la-dark la-2x">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                       </div>
                   </div>
                @endforelse
                <div class="mb-3 d-flex justify-content-end">
                    {{ $dataCourse->links() }}
                </div>
               </div>
            </div>
               
    </div>

</div>
