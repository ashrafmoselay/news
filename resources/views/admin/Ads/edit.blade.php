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
			{!! Form::open(['route'=>['admin.Ads.update',$slider->id],'method'=>'put', 'files'=>true]) !!}
				<div class="form-group">
					<label for="">Title</label>
					<input name="title" type="text" value="{{$slider->title}}" class="form-control" required="required" placeholder="Title">
				</div>
				<div class="form-group">
					<label for="">Short Description</label>
					<textarea class="form-control" name="short_desc" required="required">{{$slider->short_desc}}
					</textarea>
				</div>
				<div class="form-group">
					<label for="">Link</label>
					<input name="link" type="text" value="{{$slider->link}}" class="form-control" placeholder="Link">
				</div>
				<div class="form-group">
					<label for="">Image</label>
					<input name="image" type="file" class="form-control" >
					<img width="10%" src="{{asset('uploads/sliders/'.$slider->image)}}">
				</div>
				<div class="form-group">
					<label for="">Active</label>
					<input name="active" {{($slider->active==1)?'checked=true':''}} type="checkbox" class="form-control">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop()