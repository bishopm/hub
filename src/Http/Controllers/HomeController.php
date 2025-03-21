<?php

namespace Bishopm\Hub\Http\Controllers;

use Bishopm\Hub\Models\Tenant;
use Bishopm\Hub\Models\Page;
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

    public function group($slug){
        $data['group']=Tenant::whereSlug($slug)->first();
        return view('hub::web.group',$data);
    }

    public function groups(){
        $data['groups']=Tenant::where('publish',1)->where('active',1)->orderBy('tenant')->get();
        return view('hub::web.groups',$data);
    }

    public function page($page){
        $data['page']=Page::where('slug',$page)->where('published',1)->firstOrFail();
        return view('hub::web.page',$data);
    }

    public function subject($slug){
        $data['tag']=Tag::findFromString($slug);
        $data['posts']=Post::withAnyTags($data['tag']->name)->where('published',1)->get();
        return view('hub::web.tag',$data);
    }
}
