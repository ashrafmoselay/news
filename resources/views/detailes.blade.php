@extends('layouts.app')
@section('content')
<section id="contentSection">
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8">
      <div class="left_content">
        <div class="single_page">
          <ol class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>
            <li><a href="{{ url('/section/'.$news->category->id.'/'.str_replace(' ','-', $news->category->name)) }}">{{$news->category->name}}</a></li>
            <li class="active">{{$news->title}}</li>
          </ol>
          <h1>{{$news->title}}</h1>
          <div class="post_commentbox"> 
          <span><i class="fa fa-calendar"></i>{{$news->created_at}}</span> 
          <a href="{{ url('/section/'.$news->category->id.'/'.str_replace(' ','-', $news->category->name)) }}">
          <i class="fa fa-tags"></i>{{$news->category->name}}</a> </div>
          <div class="single_page_content"> <img class="img-center" src="{{asset('images/news').'/'.$news->image}}" alt="">
            <p>
              {{$news->short_desc}}
            </p>
            <blockquote>{!!$news->content!!}</blockquote>
          </div>
          <div class="social_link">
            <ul class="sociallink_nav">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
            </ul>
          </div>
          <div class="related_post">
            <h2>Related Post <i class="fa fa-thumbs-o-up"></i></h2>
            <ul class="spost_nav wow fadeInDown animated">
              <?php 
                $list = $news->category->news->take(6);
              ?>
              @foreach($list as $news)
              <li>
                <div class="media">
                 <a class="media-left" href="{{ url('/story/'.$news->id.'/'.str_replace(' ','-', $news->title)) }}">
                  <img src="{{asset('images/news').'/'.$news->image}}" alt="{{$news->title}}">
                  </a>
                   <div class="media-body">  <a class="catg_title" href="{{ url('/story/'.$news->id.'/'.str_replace(' ','-', $news->title)) }}"> {{$news->title}}</a> </div>
                </div>
              </li>
               @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
    <nav class="nav-slit"> <a class="prev" href="#"> <span class="icon-wrap"><i class="fa fa-angle-left"></i></span>
      <div>
        <h3>City Lights</h3>
        <img src="../images/post_img1.jpg" alt=""/> </div>
      </a> <a class="next" href="#"> <span class="icon-wrap"><i class="fa fa-angle-right"></i></span>
      <div>
        <h3>Street Hills</h3>
        <img src="../images/post_img1.jpg" alt=""/> </div>
      </a> </nav>
    <div class="col-lg-4 col-md-4 col-sm-4">
      <aside class="right_content">
        <div class="single_sidebar">
          <h2><span>Popular Post</span></h2>
          <ul class="spost_nav">
              <?php 
                $newsList = $news->category->newsOrderByViews->take(6);
              ?>
              @foreach($newsList as $story)
              <li>
                <div class="media wow fadeInDown">
                 <a class="media-left" href="{{ url('/story/'.$story->id.'/'.str_replace(' ','-', $story->title)) }}">
                  <img src="{{asset('images/news').'/'.$story->image}}" alt="{{$story->title}}">
                  </a>
                   <div class="media-body">  <a class="catg_title" href="{{ url('/story/'.$story->id.'/'.str_replace(' ','-', $story->title)) }}"> {{$story->title}}</a> </div>
                </div>
              </li>
               @endforeach
          </ul>
        </div>
        <div class="single_sidebar wow fadeInDown">
          <h2><span>Sponsor</span></h2>
            <?php 
              $adsList = \App\Ads::limit(2)->where('active',1)->inRandomOrder()->get();
            ?>
            @foreach($adsList as $ads)
            <a class="sideAdd" href="{{$ads->link}}">
              <img src="{{asset('images/Ads/'.$ads->image)}}" alt="{{$ads->title}}">
            </a>
            @endforeach 
          </div>
      </aside>
    </div>
  </div>
</section>
@stop