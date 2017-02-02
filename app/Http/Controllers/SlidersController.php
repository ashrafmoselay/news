<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Sliders;
use App\Http\Requests\SlidersRequest;
use Input;
class SlidersController extends Controller
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
        
        $title = "Sliders Index";
        //$list = DB::table('sliders')->get();
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
        if(!isset($inputs['active']))$inputs['active']=0;
        else $inputs['active']=1;
        $original = Input::file('image')->getClientOriginalName();
        $ext = explode('.', $original);
        $fileName = time().str_random(6).'.'.end($ext);
        Input::file('image')->move('images/sliders',$fileName);
        $inputs['image'] = $fileName;
        Sliders::create($inputs);
        return redirect('sliders');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Sliders::with('sliders')->findOrFail($id);
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
        if(!isset($inputs['active']))$inputs['active']=0;
        else $inputs['active']=1;
        $fileName = $news->image;
        if(!empty(Input::file('image'))){
        $original = Input::file('image')->getClientOriginalName();
        $ext = explode('.', $original);
        $fileName = time().str_random(6).'.'.end($ext);
        Input::file('image')->move('images/sliders',$fileName);
        }
        $inputs['image'] = $fileName;
        $news->update($inputs);
        return redirect('sliders');
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
       return redirect('sliders');
    }
    public function search($term){
        return Sliders::search($term);
    }
    public function changeStatus(){
        if(isset($_POST)){
            $category = Sliders::find($_POST['id']);
            $category->active = $_POST['status'];
            $category->save();
        }
    }
}
