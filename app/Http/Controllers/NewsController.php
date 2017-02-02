<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\News;
use App\Category;
use App\Http\Requests\NewsRequest;
use Input;
class NewsController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $title = "News Index";
        //$list = DB::table('news')->get();
        $list = News::Paginate();
        return view('admin.news.index',compact('title','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'News | Create';
        $categories = Category::where('active','=',1)->get(); 
        return view('admin.news.create',compact('title','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $inputs = $request->all();
        if(!isset($inputs['active']))$inputs['active']=0;
        else $inputs['active']=1;
        $original = Input::file('image')->getClientOriginalName();
        $ext = explode('.', $original);
        $fileName = time().str_random(6).'.'.end($ext);
        Input::file('image')->move('images/news',$fileName);
        $inputs['image'] = $fileName;
        News::create($inputs);
        return redirect('news');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = News::with('news')->findOrFail($id);
        $title = 'News | '.$category->name; 
        return view('admin.news.show',compact('news','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $news = News::findOrFail($id);
         $title = 'News | '.$news->title; 
         $categories = Category::where([['active','=',1],['id','<>',$id]])->get(); 
         return view('admin.news.edit',compact('news','title','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        $news = News::find($id);
        $inputs = $request->all();
        if(!isset($inputs['active']))$inputs['active']=0;
        else $inputs['active']=1;
        $fileName = $news->image;
        if(!empty(Input::file('image'))){
        $original = Input::file('image')->getClientOriginalName();
        $ext = explode('.', $original);
        $fileName = time().str_random(6).'.'.end($ext);
        Input::file('image')->move('images/news',$fileName);
        }
        $inputs['image'] = $fileName;
        $news->update($inputs);
        return redirect('news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       News::find($id)->delete();
       return redirect('news');
    }
    public function search($term){
        return News::search($term);
    }
    public function changeStatus(){
        if(isset($_POST)){
            $category = News::find($_POST['id']);
            $category->active = $_POST['status'];
            $category->save();
        }
    }
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
