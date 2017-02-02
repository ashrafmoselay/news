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
			{!! Form::open(['route'=>'Ads.store','method'=>'post', 'files'=>true]) !!}
				<div class="form-group">
					<label for="">Title</label>
					<input name="title" type="text" class="form-control"  placeholder="Title">
				</div>
				<div class="form-group">
					<label for="">Link</label>
					<input name="link" type="text" class="form-control" placeholder="Link">
				</div>
				<div class="form-group">
					<label for="">Image</label>
					<input name="image" type="file" class="form-control" >
				</div>
				<div class="form-group">
					<label for="">Active</label>
					<input name="active" type="checkbox" class="form-control">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop()