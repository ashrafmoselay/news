<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
use Request;
class CategoryController extends Controller
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
        
        $title = "Category Index";
        //$list = DB::table('admin/category')->get();
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
        $inputs['active'] = $request->has('active')?1:0;
        Category::create($inputs);
        return redirect('admin/category');
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
        
        $inputs['active'] = $request->has('active')?1:0;
        $category->update($inputs);
        $category->save();
        return redirect('admin/category');
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
       return redirect('admin/category');
    }
    public function search($term){
        return Category::search($term);
    }
    public function changeStatus(){
        if($request->isMethod('post')){
            $category = Category::find($_POST['id']);
            $category->active = $_POST['status'];
            $category->save();
        }
    }
}
