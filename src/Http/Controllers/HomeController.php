<?php

namespace Bishopm\Hub\Http\Controllers;

use Bishopm\Hub\Models\Post;
use Illuminate\Support\Facades\DB;
use Spatie\Tags\Tag;

class HomeController extends Controller
{
    public function blogpost($yr,$mth,$slug){
        $data['post']=Post::where(DB::raw('substr(published_at, 1, 4)'), '=',$yr)->where(DB::raw('substr(published_at, 6, 2)'), $mth)->where('slug',$slug)->first();
        $relatedBlogs=Post::withAnyTags($data['post']->tags)->where('slug','<>',$slug)->where('published',1)->orderBy('published_at','DESC')->get();
        $related=array();
        foreach ($relatedBlogs as $blog){
            $dum=array();
            $dum['title'] = $blog->title;
            $dum['slug'] = $blog->slug;
            $dum['published_at'] = $blog->published_at;
            $related['blogs'][date('Y',strtotime($blog->published_at))][]=$dum;
        }
        $data['related']=$related;
        return view('hub::web.blogpost',$data);
    }

    public function home(){
        $data['posts']=Post::with('person')->orderBy('published_at','DESC')->get()->take(5);
        return view('hub::web.home',$data);
    }

    public function subject($slug){
        $data['tag']=Tag::findFromString($slug);
        $data['posts']=Post::withAnyTags($data['tag']->name)->where('published',1)->get();
        return view('hub::web.tag',$data);
    }
}
