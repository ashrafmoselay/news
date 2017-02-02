<?php 
  $newsList = $category->news->take(5);
  $firstNews = $newsList->shift();
?>
<div class="single_post_content">
  <h2><span>{{$category->name}}</span></h2>
  <ul class="business_catgnav wow fadeInDown">
    <li>
      <figure class="bsbig_fig"> <a href="{{ url('/story/'.$firstNews->id.'/'.str_replace(' ','-', $firstNews->title)) }}" class="featured_img"> <img alt="{{$firstNews->title}}" src="{{asset('uploads/news').'/'.$firstNews->image}}"> <span class="overlay"></span> </a>
        <figcaption> <a href="{{ url('/story/'.$firstNews->id.'/'.str_replace(' ','-', $firstNews->title)) }}">{{$firstNews->title}}</a> </figcaption>
        <p>{{$firstNews->short_desc}}</p>
      </figure>
    </li>
  </ul>
  <ul class="spost_nav">
  @foreach($newsList as $story)
  <li>
    <div class="media wow fadeInDown">
     <a class="media-left" href="{{ url('/story/'.$story->id.'/'.str_replace(' ','-', $story->title)) }}">
      <img src="{{asset('uploads/news').'/'.$story->image}}" alt="{{$story->title}}">
      </a>
       <div class="media-body">  <a class="catg_title" href="{{ url('/story/'.$story->id.'/'.str_replace(' ','-', $story->title)) }}"> {{$story->title}}</a> </div>
    </div>
  </li>
   @endforeach
  </ul>
</div>