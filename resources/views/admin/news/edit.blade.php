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
			{!! Form::open(['route'=>['news.update',$news->id],'method'=>'put', 'files'=>true]) !!}
				<div class="form-group">
					<label for="">Title</label>
					<input name="title" type="text" value="{{$news->title}}" class="form-control" required="required" placeholder="Title">
				</div>
				<div class="form-group">
					<label for="">Category</label>
					<select name="category_id"  class="form-control" required="required">
					<option value="">--- Select Category ---</option>
					@foreach($categories as $cat)
						<option {{($cat->id==$news->category_id)?"selected='selected":''}} value="{{$cat->id}}">{{$cat->name}}</option>
					@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="">Short Description</label>
					<textarea class="form-control" name="short_desc" required="required">{{$news->short_desc}}
					</textarea>
				</div>
				<div class="form-group">
					<label for="">Content</label>
					<textarea id="contentField" class="form-control" name="content" required="required">{{$news->content}}
					</textarea>
					@ckeditor('contentField')
				</div>
				<div class="form-group">
					<label for="">Image</label>
					<input name="image" type="file" class="form-control" >
					<img width="10%" src="{{asset('images/news/'.$news->image)}}">
				</div>
				<div class="form-group">
					<label for="">Active</label>
					<input name="active" {{($news->active==1)?'checked=true':''}} type="checkbox" class="form-control">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop()