<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Ads;
use App\Http\Requests\AdsRequest;
use Input;

class AdsController extends Controller
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
        
        $title = "Ads Index";
        //$list = DB::table('Ads')->get();
        $list = Ads::Paginate();
        return view('admin.Ads.index',compact('title','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Ads | Create';
        return view('admin.Ads.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdsRequest $request)
    {
        $inputs = $request->all();
        if(!isset($inputs['active']))$inputs['active']=0;
        else $inputs['active']=1;
        $original = Input::file('image')->getClientOriginalName();
        $ext = explode('.', $original);
        $fileName = time().str_random(6).'.'.end($ext);
        Input::file('image')->move('images/Ads',$fileName);
        $inputs['image'] = $fileName;
        Ads::create($inputs);
        return redirect('Ads');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Ads::with('Ads')->findOrFail($id);
        $title = 'Ads | '.$category->name; 
        return view('admin.Ads.show',compact('Ads','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $slider = Ads::findOrFail($id);
         $title = 'Ads | '.$slider->title;  
         return view('admin.Ads.edit',compact('slider','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdsRequest $request, $id)
    {
        $news = Ads::find($id);
        $inputs = $request->all();
        if(!isset($inputs['active']))$inputs['active']=0;
        else $inputs['active']=1;
        $fileName = $news->image;
        if(!empty(Input::file('image'))){
        $original = Input::file('image')->getClientOriginalName();
        $ext = explode('.', $original);
        $fileName = time().str_random(6).'.'.end($ext);
        Input::file('image')->move('images/Ads',$fileName);
        }
        $inputs['image'] = $fileName;
        $news->update($inputs);
        return redirect('Ads');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Ads::find($id)->delete();
       return redirect('Ads');
    }
    public function search($term){
        return Ads::search($term);
    }
    public function changeStatus(){
        if(isset($_POST)){
            $category = Ads::find($_POST['id']);
            $category->active = $_POST['status'];
            $category->save();
        }
    } 
}
