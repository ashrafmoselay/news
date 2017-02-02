@extends('admin.layouts.app')
@section('content')
<div class="container">
 	<div class="row">
	    <div class="col-xs-12">
			@if(count($errors) >0)
			<ul class="alert alert-danger">
			@foreach($errors->all() as $err)
			<li>{{$err}}</li>
			@endforeach
			</ul>
			@endif
		</div>
	</div>
    <div class="row">
        <div class="col-md-12">
			{!! Form::open(['route'=>'category.store','method'=>'post']) !!}
				<div class="form-group">
					<label for="">Category Name</label>
					<input name="name" type="text" class="form-control" id="" placeholder="Category Name">
				</div>
				<div class="form-group">
					<label for="">Parent Category</label>
					<select name="parent_id"  class="form-control" required="required">
					<option value="">--- Select Category ---</option>
					@foreach($categories as $cat)
						<option value="{{$cat->id}}">{{$cat->name}}</option>
					@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="">Active</label>
					<input name="active" type="checkbox" class="form-control">
				</div>
				<div class="form-group">
					<label for="">Sort</label>
					<input name="sort" type="text" class="form-control" id="" placeholder="Sort">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop()