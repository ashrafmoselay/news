@extends('admin.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
			{!! Form::open(['route'=>['category.update',$category->id],'method'=>'put']) !!}
				<div class="form-group">
					<label for="">Category Name</label>
					<input name="name" type="text" value="{{$category->name}}" class="form-control" id="" placeholder="Input field">
				</div>
				<div class="form-group">
					<label for="">Parent Category</label>
					<select name="parent_id"  class="form-control" required="required">
					<option value="">--- Select Category ---</option>
					@foreach($categories as $cat)
						
						<option {{($cat->id==$category->parent_id)?"selected='selected":''}} value="{{$cat->id}}">{{$cat->name}}</option>
					@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="">Active</label>
					<input name="active" type="checkbox" {{($category->active==1)?'checked=true':''}}   class="form-control">
				</div>
				<div class="form-group">
					<label for="">Sort</label>
					<input name="sort" type="text" class="form-control" value="{{$category->sort}}" id="" placeholder="Sort">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button> 
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop()