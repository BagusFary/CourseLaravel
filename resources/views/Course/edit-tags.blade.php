@extends('layouts.dashboard')

@section('content')
<div class="container">

  <h2 class="mb-2">List Tags</h2>
  @foreach ($dataTags as $item)
      <h4>{{ $item->title }}</h4>
  @endforeach
    
   
    @if(Session::has('approve-message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="fa-regular fa-circle-check fa-xl"></i><strong> {{ Session::get('approve-message') }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if(Session::has('cancel-message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <i class="fa-regular fa-circle-check fa-xl"></i><strong> {{ Session::get('cancel-message') }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="d-flex justify-content-end mb-2">
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTags">Add Tags</button>
    </div>

    <div class="modal fade" id="addTags" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Tags</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          @foreach ($dataTags as $item)
          <div class="modal-body">
               <form action="/store-tags/{{ $item->id }}" method="post"> 
                @csrf

            <input type="text" name="name_tags" class="form-control">

          </div>
          @endforeach
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-outline-success" type="submit">Create Tags</button>
          </form>
          </div>
        </div>
      </div>
    </div>
    <table class="table table-secondary table-striped">
        <tr>
            <th>#</th>
            <th>Tags Name</th>
            <th>Action</th>

        </tr>
        @foreach ($dataTags as $item)
        @forelse ($item->tags as $tag)
            
        <tr>
            <td>{{ $loop->iteration}}</td>
            <td>{{ $tag->name_tags }}</td>
            <td>  

              <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editTags-{{ $tag->id }}">
                <i class="fa-solid fa-pencil"></i>
              </button>    
              <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTags-{{ $tag->id }}">
                <i class="fa-solid fa-trash"></i>
              </button>          
       
            </td>
        </tr>
        <div class="modal fade" id="editTags-{{ $tag->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Tags</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/update-tags/{{ $tag->id }}" method="post">
                      @csrf
                      @method('put')
                    <input type="text" id="name_tags" name="name_tags" class="form-control" value="{{ $tag->name_tags }}" placeholder="{{ $tag->name_tags }}">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button class="btn btn-success" type="submit">Save</button>
                  </form>
                  
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="deleteTags-{{ $tag->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Tags</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <p class="lead">{{ $tag->name_tags }}</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <form action="/delete-tags/{{ $tag->id }}" method="POST">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-outline-danger">Delete this tag</button>
                  </form>
                  
                </div>
              </div>
            </div>
          </div>

          @empty
          
          <h3 class="d-flex justify-content-center">There is no tags</h3>

        @endforelse
        @endforeach
    </table>
</div>


@endsection