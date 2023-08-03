<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Course;
use App\Models\CourseTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
    public function index(Request $request){
        $keyword = $request->keyword;
        $dataCourse = Course::with('tags:id,name_tags')
                            ->where('title', 'LIKE', '%'.$keyword.'%')
                            ->orWhereHas('tags', function($query) use($keyword){
                                $query->where('name_tags', 'LIKE', '%'.$keyword.'%');
                            })
                            ->paginate(3)
                            ->withQueryString();
        return view('Course.index', ['dataCourse' => $dataCourse]);
    }

    public function detail($id){
        $dataCourse = Course::where('id',$id)->first();
        if($dataCourse){
            return view('Course.detail', ['dataCourse' => $dataCourse]);
        } else {
            return response()->view('Error.coursenotfound');
        }
    }

    public function create(){
        return view('Course.create');
    }

    public function store(CreateCourseRequest $request){
        if(Auth::user()->role != "admin"){
            return response()->view('Error.unauthorized');
        } else {

            DB::transaction(function () use($request){
                $videoExtension = $request->file('video')->getClientOriginalExtension();
                $videoName = "video"."-".now()->timestamp.".".$videoExtension;

                $thumbnailExtension = $request->file('thumbnail')->getClientOriginalExtension();
                $thumbnailName = now()->timestamp.".".$thumbnailExtension;
                
                $request->file('thumbnail')->storeAs('thumbnail', $thumbnailName);
                $request->file('video')-> storeAs('video',$videoName);
            
            
            $course =  Course::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'thumbnail' => $thumbnailName,
                    'video' => $videoName,
                    'price' => $request->price,
                ]);
                
                $tags = explode(" ", $request->name_tags);
                $count = count($tags);

                foreach(explode(" ", $request->name_tags) as $item){
                    Tag::create([

                        'name_tags' => $item
                        
                    ]);
                }

                $tagId = Tag::orderBy('id', 'DESC')->take($count)->get();
                foreach($tagId as $tag){
                    CourseTag::create([
                        'course_id' => $course->id,
                        'tag_id' => $tag->id,
                    ]);
                    
                }

                if($course){
                    Session::flash('success', 'Course Successfully Created!');
                } else {
                    Session::flash('failed', 'Course Failed to be Created');
                }

            });
        }

        return redirect('/show-all-courses');
    }

    public function edit($id){
        if(Auth::user()->role != "admin"){
            return response()->view('Error.unauthorized');
        } else {
            $dataCourse = Course::with('tags:id,name_tags')
                                ->findOrFail($id);
                        $tagName = array();
                        foreach($dataCourse->tags as $tag){
                            $tagName[] = $tag->name_tags;
                            
                        }
        }

        return view('Course.edit', ['dataCourse' => $dataCourse, 'tagName' => $tagName]);
    }

    public function update(UpdateCourseRequest $request, $id){

        if(Auth::user()->role != "admin"){
            return response()->view('Error.unauthorized');
        } else {

            if($request->file('thumbnail')){

                $oldFile = Course::findOrFail($id);
                Storage::delete('thumbnail/'. $oldFile->thumbnail);
                $extension = $request->file('thumbnail')->getClientOriginalExtension();
                $thumbnailName = now()->timestamp.".".$extension;
                $request->file('thumbnail')->storeAs('thumbnail', $thumbnailName);
                $dataCourse = Course::findOrFail($id);
                $dataCourse->update([
                    
                    'title' => $request->title,
                    'description' => $request->description,
                    'thumbnail' => $thumbnailName,
                    'price' => $request->price,

                ]);
            } 
            
            if($request->file('video')) {
                
                $oldFile = Course::findOrFail($id);
                Storage::delete('video/'. $oldFile->video);
                $extension = $request->file('video')->getClientOriginalExtension();
                $videoName = "video"."-".now()->timestamp.".".$extension;
                $request->file('video')->storeAs('video', $videoName);
                $dataCourse = Course::findOrFail($id);
                $dataCourse->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'video' => $videoName,
                    'price' => $request->price,
                ]);
            }

            $dataCourse = Course::findOrFail($id);
            $dataCourse->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
            ]);
        }

        Alert::success('Update Saved', 'Course has been updated!');

        return redirect('/show-all-courses');

    }

    public function delete($id){
        if(Auth::user()->role != "admin"){
            return response()->view("Error.unauthorized");
            } else {

            $dataCourse = Course::with('tags:id,name_tags')
                                ->findOrFail($id);
            return view('Course.delete', ['dataCourse' => $dataCourse]);
        }
    }

    public function destroy($id){
        if(Auth::user()->role != "admin"){
            return response()->view("Error.unauthorized");
        } else {

            DB::transaction(function() use($id){
                $dataCourse = Course::with('tags:id,name_tags')
                                    ->findOrFail($id);
                Storage::delete('thumbnail/'. $dataCourse->thumbnail);
                Storage::delete('video/'. $dataCourse->video);
                $dataCourse->delete();
                
                foreach($dataCourse->tags as $tag){
                    $deleteTag = Tag::findOrFail($tag->id);
                    $deleteTag->delete();
                }

                if($dataCourse){
                    Session::flash('success', 'Course Successfully Deleted!');
                } else {
                    Session::flash('failed', 'Course Failed to be deleted');
                }
            });
            
        }

        
        return redirect('/show-all-courses');
    }

    public function editTags($id){
        if(Auth::user()->role != "admin"){
            return response()->view('Error.unathorized');
        } else {
            $dataTags = Course::where('id', $id)
                                ->with('tags:id,name_tags')
                                ->paginate(5);
    
            return view('Course.edit-tags', ['dataTags' => $dataTags]);
        }
    }

    public function updateTags(Request $request, $id){
        if(Auth::user()->role != 'admin'){
            return response()->view('Error.unathorized');
        } else {
            $tags = Tag::findOrFail($id);
            $tags->update([
                'name_tags' => $request->name_tags
            ]);

            if($tags){
                Session::flash('success', 'Tag Edited');
            } else {
                Session::flash('failed', 'Failed to Update Tag');
            }

            return redirect()->back();
        }
    }

    public function storeTags(Request $request, $id){
        if(Auth::user()->role != 'admin'){
            return response()->view('Error.unathorized');
        } else {
            DB::transaction( function() use($request, $id){
                $tags = explode(" ", $request->name_tags);
        
                $count = count($tags);
        
                foreach($tags as $tag){
                    Tag::create([
                        'name_tags' => $tag
                    ]);
                }
        
                $tagId = Tag::orderby('id', 'DESC')->take($count)->select('id')->get();
                foreach($tagId as $tag){
                    $Tag = CourseTag::create([
                        'course_id' => $id,
                        'tag_id' => $tag->id
                    ]);
                }
    
                if($Tag){
                    Session::flash('success', 'Tag Created');
                } else {
                    Session::flash('failed', 'Tag Failed to be created');
                }
            });
            
            return redirect(url()->previous());
            
        }
    }

    public function deleteTags($id){
        if(Auth::user()->role != 'admin'){
            return response()->view('Error.unauthorized');
        } else {
            $tags = Tag::findOrFail($id);
            $tags->delete();

            if($tags){
                Session::flash('success', 'Tag Deleted Successfully');
            } else {
                Session::flash('failed', 'Tag Failed to be Deleted');
            }
            
            return redirect(url()->previous());
        }
    }
}
