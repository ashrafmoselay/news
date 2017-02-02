<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Sliders;
use App\Http\Requests\SlidersRequest;

use App\Http\Controllers\Controller;
use Storage;
class SlidersController extends Controller
{
     public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $title = "Sliders Index";
        //$list = DB::table('admin/sliders')->get();
        $list = Sliders::Paginate();
        return view('admin.sliders.index',compact('title','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Sliders | Create';
        return view('admin.sliders.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlidersRequest $request)
    {
        $inputs = $request->all();
        $inputs['active'] = $request->has('active')?1:0;
        /*$original = $request->file('image')->getClientOriginalName();
        $ext = explode('.', $original);
        $fileName = time().str_random(6).'.'.end($ext);
        $request->file('image')->move('images/sliders',$fileName);*/
        $ext = $request->image->extension();
        $fileName = time().str_random(6).'.'.$ext;
        $path = 'sliders/'.$fileName;
        Storage::put($path,  file_get_contents($request->file('image')->getRealPath()));
        $inputs['image'] = $fileName;
        Sliders::create($inputs);
        return redirect('admin/sliders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Sliders::with('admin/sliders')->findOrFail($id);
        $title = 'Sliders | '.$category->name; 
        return view('admin.sliders.show',compact('sliders','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $slider = Sliders::findOrFail($id);
         $title = 'Sliders | '.$slider->title;  
         return view('admin.sliders.edit',compact('slider','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlidersRequest $request, $id)
    {
        $news = Sliders::find($id);
        $inputs = $request->all();
        $inputs['active'] = $request->has('active')?1:0;
        $fileName = $news->image;
        if(!empty($request->file('image'))){
            /*$original = $request->file('image')->getClientOriginalName();
            $ext = explode('.', $original);
            $fileName = time().str_random(6).'.'.end($ext);
            $request->file('image')->move('images/sliders',$fileName);*/
            $ext = $request->image->extension();
            $fileName = time().str_random(6).'.'.$ext;
            $path = 'sliders/'.$fileName;
            Storage::put($path,  file_get_contents($request->file('image')->getRealPath()));
        }
        $inputs['image'] = $fileName;
        $news->update($inputs);
        return redirect('admin/sliders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Sliders::find($id)->delete();
       return redirect('admin/sliders');
    }
    public function search($term){
        return Sliders::search($term);
    }
    public function changeStatus(){
        if($request->isMethod('post')){
            $category = Sliders::find($_POST['id']);
            $category->active = $_POST['status'];
            $category->save();
        }
    }
}
