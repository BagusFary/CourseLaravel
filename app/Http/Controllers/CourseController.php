<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Course;
use App\Models\CourseTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
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
        $dataCourse = Course::findOrFail($id);
        return view('Course.detail', ['dataCourse' => $dataCourse]);
    }

    public function create(){
        return view('Course.create');
    }

    public function store(CreateCourseRequest $request){

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

        });


        return redirect('/show-all-courses');
    }

    public function edit($id){
        $dataCourse = Course::with('tags:id,name_tags')
                            ->findOrFail($id);
                    $tagName = array();
                    foreach($dataCourse->tags as $tag){
                        $tagName[] = $tag->name_tags;
                        
                    }


        return view('Course.edit', ['dataCourse' => $dataCourse, 'tagName' => $tagName]);
    }

    public function update(UpdateCourseRequest $request, $id){

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


        return redirect('/show-all-courses');

    }

    public function delete($id){
        $dataCourse = Course::with('tags:id,name_tags')
                            ->findOrFail($id);
        return view('Course.delete', ['dataCourse' => $dataCourse]);
    }

    public function destroy($id){
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
        });
        
        return redirect('/show-all-courses');
    }

    public function editTags($id){
        $dataTags = Course::where('id', $id)
                            ->with('tags:id,name_tags')
                            ->get();

        return view('Course.edit-tags', ['dataTags' => $dataTags]);
    }

    public function updateTags(Request $request, $id){
        $tags = Tag::findOrFail($id);
        $tags->update([
            'name_tags' => $request->name_tags
        ]);

        return redirect()->back();
    }

    public function storeTags(Request $request, $id){

        $tags = explode(" ", $request->name_tags);

        $count = count($tags);

        foreach($tags as $tag){
            Tag::create([
                'name_tags' => $tag
            ]);
        }

        $tagId = Tag::orderby('id', 'DESC')->take($count)->select('id')->get();
        foreach($tagId as $tag){
            CourseTag::create([
                'course_id' => $id,
                'tag_id' => $tag->id
            ]);
        }
        
        return redirect()->back();
        
    }

    public function deleteTags($id){
        $tags = Tag::findOrFail($id);
        $tags->delete();
        return redirect()->back();
    }


}
