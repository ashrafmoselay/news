<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
  <header id="header">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_top">
          <div class="header_top_left">
            <ul class="top_nav">
              <li><a href="{{ url('/') }}">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="pages/contact.html">Contact</a></li>
            </ul>
          </div>
          <div class="header_top_right">
            <p>{{ date('l j F Y g:i a')}}</p>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_bottom">
          <div class="logo_area"><a href="{{ url('/') }}" class="logo"><img src="{{asset('/assets/front/images')}}/logo.jpg" alt=""></a></div>
          <div class="add_banner"><a href="#"><img src="{{asset('/assets/front/images')}}/addbanner_728x90_V1.jpg" alt=""></a></div>
        </div>
      </div>
    </div>
  </header>
  <section id="navArea">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav main_nav">
          <li class="active"><a href="{{ url('/') }}"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>
          <?php 
            $list = \App\Category::with('childs')->where('parent_id',0)->get();
          ?>
          @foreach($list as $cat)
            @if(count($cat->childs))
              <li class="dropdown"> 
              <a href="{{ url('/section/'.$cat->id.'/'.str_replace(' ','-', $cat->name)) }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{$cat->name}}</a>
              <ul class="dropdown-menu" role="menu">
                @foreach($cat->childs as $child)
                 <li><a href="{{ url('/section/'.$child->id.'/'.str_replace(' ','-', $child->name)) }}">{{$child->name}}</a></li>
                @endforeach
              </ul>
              </li>
            @else
            <li><a href="{{ url('/section/'.$cat->id.'/'.str_replace(' ','-', $cat->name)) }}">{{$cat->name}}</a></li>
           @endif
          @endforeach
        </ul>
      </div>
    </nav>
  </section>
  <section id="newsSection">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="latest_newsarea"> <span>Latest News</span>
          <?php 
            $list = \App\News::limit(10)->where('active',1)->orderBy('id','DESC')->get();
          ?>
          <ul id="ticker01" class="news_sticker">
            @foreach($list as $news)
            <li><a href="{{ url('/story/'.$news->id.'/'.str_replace(' ','-', $news->title)) }}"><img src="{{asset('images/news').'/'.$news->image}}" alt="">{{$news->title}}</a></li>
             @endforeach
          </ul>
          <div class="social_area">
            <ul class="social_nav">
              <li class="facebook"><a href="#"></a></li>
              <li class="twitter"><a href="#"></a></li>
              <li class="flickr"><a href="#"></a></li>
              <li class="pinterest"><a href="#"></a></li>
              <li class="googleplus"><a href="#"></a></li>
              <li class="vimeo"><a href="#"></a></li>
              <li class="youtube"><a href="#"></a></li>
              <li class="mail"><a href="#"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>