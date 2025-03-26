<?php

namespace Bishopm\Hub\Http\Controllers;

use Bishopm\Hub\Models\Diaryentry;
use Bishopm\Hub\Models\Tenant;
use Bishopm\Hub\Models\Page;
use Bishopm\Hub\Models\Post;
use Bishopm\Hub\Models\Project;
use Bishopm\Hub\Models\Resident;
use Bishopm\Hub\Models\Venue;
use Bishopm\Hub\Models\Tag;
use Illuminate\Support\Facades\DB;
use Spatie\Tags\Tag as SpatieTag;

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

    public function group($slug){
        $data['group']=Tenant::with(['diaryentries.venue','diaryentries' => function ($q) { 
            $q->where('diarydatetime', '>', date('Y-m-d'))
              ->orderBy('diarydatetime', 'ASC')->first();
        }])->whereSlug($slug)->first();
        return view('hub::web.group',$data);
    }

    public function groups(){
        $data['groups']=Tenant::where('publish',1)->where('active',1)->orderBy('tenant')->get();
        return view('hub::web.groups',$data);
    }

    public function home(){
        $data['residents']=Resident::orderBy('resident','ASC')->get()->toArray();
        $today=date('Y-m-d');
        $diaryentries=Diaryentry::with('diarisable','venue')->where('diarydatetime','>=',$today . " 00:00:00")->where('diarydatetime','<=',$today . " 23:59:59")->where('diarisable_type','tenant')->get();
        foreach ($diaryentries as $entry){
            $data['diaryentries'][date('H:i',strtotime($entry->diarydatetime))][]=$entry;
        }
        if (count($diaryentries)){
            ksort($data['diaryentries']);
        } else {
            $data['diaryentries']=[];
        }
        $data['posts']=Post::with('person')->orderBy('published_at','DESC')->get()->take(5);
        $tags=DB::connection('church')->table('tags')
        ->join('taggables','tags.id','=','taggables.tag_id')
        ->where('taggables.taggable_type','=','project')->orWhere('taggables.taggable_type','=','tenant')
        ->orderBy('name')->get();
        foreach ($tags as $tag){
            $data['tags'][$tag->slug]=[
                'name' => $tag->name,
                'slug' => $tag->slug
            ];
        }
        return view('hub::web.home',$data);
    }

    public function page($page){
        $data['resident']=Resident::where('slug',$page)->where('publish',1)->first();
        if (!$data['resident']){
            $data['page']=Page::where('slug',$page)->where('published',1)->firstOrFail();
            return view('hub::web.page',$data);
        } else {
            return view('hub::web.resident',$data);
        }
    }

    public function project($slug){
        $data['project']=Project::with(['diaryentries.venue','diaryentries' => function ($q) { 
            $q->where('diarydatetime', '>', date('Y-m-d'))
              ->orderBy('diarydatetime', 'ASC')->first();
        }])->whereSlug($slug)->first();
        return view('hub::web.project',$data);
    }

    public function projects(){
        $data['projects']=Project::orderBy('project')->get();
        return view('hub::web.projects',$data);
    }

    public function subject($slug){
        $data['posts']=[];//Post::withAnyTags($slug)->where('published',1)->get();
        $data['groups']=DB::connection('church')->table('tenants')
            ->join('taggables','tenants.id','=','taggables.taggable_id')->join('tags','tags.id','=','taggables.tag_id')
            ->where('tags.slug',$slug)->where('taggables.taggable_type','tenant')
            ->select('tenant','tenants.slug')->get();
        $data['projects']=DB::connection('church')->table('projects')
            ->join('taggables','projects.id','=','taggables.taggable_id')->join('tags','tags.id','=','taggables.tag_id')
            ->where('tags.slug',$slug)->where('taggables.taggable_type','project')
            ->select('project','projects.slug')->get();
        $data['slug']=$slug;
        return view('hub::web.tag',$data);
    }

    public function venue($slug){
        $data['venue']=Venue::whereSlug($slug)->first();
        return view('hub::web.venue',$data);
    }

    public function venues(){
        $data['venues']=Venue::orderBy('venue')->where('publish',1)->get();
        return view('hub::web.venues',$data);
    }
}
