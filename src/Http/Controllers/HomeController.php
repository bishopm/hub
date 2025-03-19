<?php

namespace Bishopm\Hub\Http\Controllers;

use Bishopm\Hub\Models\Post;

class HomeController extends Controller
{

    public function home(){
        $data['posts']=Post::with('person')->orderBy('published_at','DESC')->get()->take(1);
        return view('hub::web.home',$data);
    }
}
