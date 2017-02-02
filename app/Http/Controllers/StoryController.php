<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\News;
class StoryController extends Controller
{
    public function detailes($id,$title){
        $news = News::find($id);
        $view = $news->views + 1; 
        $news->views = $view;
        $news->save();
        $title = $news->title;
        return view('detailes',compact('news','title'));
    }
    public function category($id,$title){
        $news = News::where([['active',1],['category_id',$id]])->Paginate(20);
        $title = $news[0]->category->name;
        return view('category',compact('news','title'));
    }
}
