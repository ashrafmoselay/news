@extends('layouts.app')
@section('content')
<section id="contentSection">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="left_content">
        <div class="single_page">
          <ol class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
            <li class="active">{{$news[0]->category->name}}</li>
          </ol>
          	<div class="newsSection">
          		<h1>{{strtoupper($news[0]->category->name)}}</h1>
          	</div>
          	<ul class=" wow fadeInDown categoryList">
		    @foreach($news as $story)
		    <li class="col-lg-3">
		      <figure class="bsbig_fig"> <a href="{{ url('/story/'.$story->id.'/'.str_replace(' ','-', $story->title)) }}" class="featured_img"> <img alt="{{$story->title}}" src="{{asset('images/news').'/'.$story->image}}"> <span class="overlay"></span> </a>
		        <figcaption> <a href="{{ url('/story/'.$story->id.'/'.str_replace(' ','-', $story->title)) }}">{{$story->title}}</a> </figcaption>
		        <p>{{$story->short_desc}}</p>
		      </figure>
		    </li>
		     @endforeach
		  </ul>
		 <div class="row text-center col-md-12">
		 	{!! $news->render() !!}
		 </div>
         </div>
        </div>
     </div>
    </div>
@stop