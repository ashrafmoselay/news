@extends('layouts.app')
@section('content')
<?php echo View::make('slider') ?>
<?php 
  $catgories = \App\Category::limit(6)->with('news')->where([['parent_id',0],['active',1]])->orderBy('sort')->get();
  $category = $catgories->shift();
  $newsList = $category->news->take(5);
  $firstNews = $newsList->shift();
?>
<section id="contentSection">
  <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <?php echo View::make('partial.horizontal_list',compact('category')) ?>
          <div class="fashion_technology_area">
            <div class="fashion">
              <?php 
                $category = $catgories->shift();
                echo View::make('partial.vertical_list',compact('category'));
              ?>
            </div>
            <div class="technology">
              <?php 
                $category = $catgories->shift();
                echo View::make('partial.vertical_list',compact('category'));
              ?>
            </div>
          </div>
          <div class="single_post_content">
            <h2><span>Photography</span></h2>
            <?php 
              $photo = \App\Gallery::limit(6)->where('active',1)->orderBy('id','DESC')->get();
            ?>
            <ul class="photograph_nav  wow fadeInDown">
              @foreach($photo as $img)
                <li>
                  <div class="photo_grid">
                    <figure class="effect-layla"> <a class="fancybox-buttons" data-fancybox-group="button" href="{{asset('uploads/gallery/'.$img->image)}}" title="{{$img->title}}"> <img src="{{asset('uploads/gallery/'.$img->image)}}" alt="{{$img->title}}"/></a> </figure>
                  </div>
                </li>
                @endforeach
            </ul>
          </div>
          <?php
            $category = $catgories->shift(); 
            echo View::make('partial.horizontal_list',compact('category'));
          ?>

          <div class="fashion_technology_area">
            <div class="fashion">
              <?php 
                $category = $catgories->shift();
                echo View::make('partial.vertical_list',compact('category'));
              ?>
            </div>
            <div class="technology">
              <?php 
                $category = $catgories->shift();
                echo View::make('partial.vertical_list',compact('category'));
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <aside class="right_content">
          <div class="single_sidebar">
            <h2><span>Popular Post</span></h2>
            <?php 
              $list = \App\News::limit(4)->where('active',1)->orderBy('views','DESC')->get();
            ?>
            <ul class="spost_nav">
              @foreach($list as $news)
              <li>
                <div class="media wow fadeInDown">
                 <a class="media-left" href="{{ url('/story/'.$news->id.'/'.str_replace(' ','-', $news->title)) }}">
                  <img src="{{asset('uploads/news').'/'.$news->image}}" alt="{{$news->title}}">
                  </a>
                   <div class="media-body">  <a class="catg_title" href="{{ url('/story/'.$news->id.'/'.str_replace(' ','-', $news->title)) }}"> {{$news->title}}</a> </div>
                </div>
              </li>
               @endforeach
            </ul>
          </div>
          <div class="single_sidebar">
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#category" aria-controls="home" role="tab" data-toggle="tab">Category</a></li>
              <li role="presentation"><a href="#video" aria-controls="profile" role="tab" data-toggle="tab">Video</a></li>
              <li role="presentation"><a href="#comments" aria-controls="messages" role="tab" data-toggle="tab">Comments</a></li>
            </ul>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="category">
                <ul>
                  <li class="cat-item"><a href="#">Sports</a></li>
                  <li class="cat-item"><a href="#">Fashion</a></li>
                  <li class="cat-item"><a href="#">Business</a></li>
                  <li class="cat-item"><a href="#">Technology</a></li>
                  <li class="cat-item"><a href="#">Games</a></li>
                  <li class="cat-item"><a href="#">Life &amp; Style</a></li>
                  <li class="cat-item"><a href="#">Photography</a></li>
                </ul>
              </div>
              <div role="tabpanel" class="tab-pane" id="video">
                <div class="vide_area">
                  <iframe width="100%" height="250" src="http://www.youtube.com/embed/h5QWbURNEpA?feature=player_detailpage" frameborder="0" allowfullscreen></iframe>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="comments">
                <ul class="spost_nav">
                  <li>
                    <div class="media wow fadeInDown"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="{{asset('/assets/front/images')}}/post_img1.jpg"> </a>
                      <div class="media-body"> <a href="pages/single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 1</a> </div>
                    </div>
                  </li>
                  <li>
                    <div class="media wow fadeInDown"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="{{asset('/assets/front/images')}}/post_img2.jpg"> </a>
                      <div class="media-body"> <a href="pages/single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 2</a> </div>
                    </div>
                  </li>
                  <li>
                    <div class="media wow fadeInDown"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="{{asset('/assets/front/images')}}/post_img1.jpg"> </a>
                      <div class="media-body"> <a href="pages/single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 3</a> </div>
                    </div>
                  </li>
                  <li>
                    <div class="media wow fadeInDown"> <a href="pages/single_page.html" class="media-left"> <img alt="" src="{{asset('/assets/front/images')}}/post_img2.jpg"> </a>
                      <div class="media-body"> <a href="pages/single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 4</a> </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="single_sidebar wow fadeInDown">
            <h2><span>Sponsor</span></h2>
            <?php 
              $adsList = \App\Ads::limit(7)->where('active',1)->get();
            ?>
            @foreach($adsList as $ads)
            <a class="sideAdd" href="{{$ads->link}}">
              <img src="{{asset('uploads/Ads/'.$ads->image)}}" alt="{{$ads->title}}">
            </a>
            @endforeach 
          </div>
          <div class="single_sidebar wow fadeInDown">
            <h2><span>Category Archive</span></h2>
            <select class="catgArchive">
              <option>Select Category</option>
              <option>Life styles</option>
              <option>Sports</option>
              <option>Technology</option>
              <option>Treads</option>
            </select>
          </div>
          <div class="single_sidebar wow fadeInDown">
            <h2><span>Links</span></h2>
            <ul>
              <li><a href="#">Blog</a></li>
              <li><a href="#">Rss Feed</a></li>
              <li><a href="#">Login</a></li>
              <li><a href="#">Life &amp; Style</a></li>
            </ul>
          </div>
        </aside>
      </div>
    </div>
</section>
@endsection
