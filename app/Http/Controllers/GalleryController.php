<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Gallery;
use App\Http\Requests\GalleryRequest;
use Input;
class GalleryController extends Controller
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
        
        $title = "Gallery Index";
        //$list = DB::table('gallery')->get();
        $list = Gallery::Paginate();
        return view('admin.gallery.index',compact('title','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Gallery | Create';
        return view('admin.gallery.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $inputs = $request->all();
        if(!isset($inputs['active']))$inputs['active']=0;
        else $inputs['active']=1;
        $original = Input::file('image')->getClientOriginalName();
        $ext = explode('.', $original);
        $fileName = time().str_random(6).'.'.end($ext);
        Input::file('image')->move('images/gallery',$fileName);
        $inputs['image'] = $fileName;
        Gallery::create($inputs);
        return redirect('gallery');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Gallery::with('gallery')->findOrFail($id);
        $title = 'Gallery | '.$category->name; 
        return view('admin.gallery.show',compact('gallery','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $slider = Gallery::findOrFail($id);
         $title = 'Gallery | '.$slider->title;  
         return view('admin.gallery.edit',compact('slider','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id)
    {
        $news = Gallery::find($id);
        $inputs = $request->all();
        if(!isset($inputs['active']))$inputs['active']=0;
        else $inputs['active']=1;
        $fileName = $news->image;
        if(!empty(Input::file('image'))){
        $original = Input::file('image')->getClientOriginalName();
        $ext = explode('.', $original);
        $fileName = time().str_random(6).'.'.end($ext);
        Input::file('image')->move('images/gallery',$fileName);
        }
        $inputs['image'] = $fileName;
        $news->update($inputs);
        return redirect('gallery');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Gallery::find($id)->delete();
       return redirect('gallery');
    }
    public function search($term){
        return Gallery::search($term);
    }
    public function changeStatus(){
        if(isset($_POST)){
            $category = Gallery::find($_POST['id']);
            $category->active = $_POST['status'];
            $category->save();
        }
    }
}
