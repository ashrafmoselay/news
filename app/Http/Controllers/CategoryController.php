<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Http\Requests\CategoryRequest;
use Request;
class CategoryController extends Controller
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
        
        $title = "Category Index";
        //$list = DB::table('category')->get();
        $list = Category::Paginate();
        return view('admin.category.index',compact('title','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Category | Create';
        $categories = Category::where('active','=',1)->get(); 
        return view('admin.category.create',compact('title','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $inputs = $request->all();
        if(!isset($inputs['active']))$inputs['active']=0;
        else $inputs['active']=1;
        Category::create($inputs);
        return redirect('category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::with('news')->findOrFail($id);
        $title = 'Category | '.$category->name; 
        return view('admin.category.show',compact('category','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $category = Category::findOrFail($id);
         $title = 'Category | '.$category->name; 
         $categories = Category::where([['active','=',1],['id','<>',$id]])->get(); 
         return view('admin.category.edit',compact('category','title','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);
        //$category->name = Request::get('name');
        $inputs = $request->all();
        
        if(!isset($inputs['active']))$inputs['active']=0;
        else $inputs['active']=1;
        $category->update($inputs);
        $category->save();
        return redirect('category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Category::find($id)->delete();
       return redirect('category');
    }
    public function search($term){
        return Category::search($term);
    }
    public function changeStatus(){
        if(isset($_POST)){
            $category = Category::find($_POST['id']);
            $category->active = $_POST['status'];
            $category->save();
        }
    }
}
