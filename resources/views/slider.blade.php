<?php 
$sliders = \App\Sliders::limit(5)->where('active',1)->orderBy('id','DESC')->get();
?>
<section id="sliderSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="slick_slider">
          @foreach($sliders as $slider)
          <div class="single_iteam"> 
          <a href="pages/single_page.html"> 
            <img src="{{asset('uploads/sliders/'.$slider->image)}}" alt="">
          </a>
            <div class="slider_article">
              <h2>
              <a class="slider_tittle" href="{{$slider->link}}">
                {{$slider->title}}</a>
              </h2>
              <p>{{$slider->short_desc}}</p>
            </div>
          </div>
           @endforeach
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="latest_post">
          <h2><span>Latest post</span></h2>
          <div class="latest_post_container">
            <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
             <?php 
              $list = \App\News::limit(5)->where('active',1)->orderBy('id','DESC')->get();
            ?>
            <ul class="latest_postnav">
              @foreach($list as $news)
              <li>
                <div class="media">
                 <a class="media-left" href="{{ url('/story/'.$news->id.'/'.str_replace(' ','-', $news->title)) }}">
                  <img src="{{asset('uploads/news').'/'.$news->image}}" alt="{{$news->title}}">
                  </a>
                   <div class="media-body">  <a class="catg_title" href="{{ url('/story/'.$news->id.'/'.str_replace(' ','-', $news->title)) }}"> {{$news->title}}</a> </div>
                </div>
              </li>
               @endforeach
            </ul>
            <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
          </div>
        </div>
      </div>
    </div>
  </section>