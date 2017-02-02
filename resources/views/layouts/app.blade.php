<!DOCTYPE html>
<html>
<head>
<title>{{ isset($title)?$title:'News' }}</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/')}}/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/')}}/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/')}}/css/animate.css">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/')}}/css/font.css">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/')}}/css/li-scroller.css">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/')}}/css/slick.css">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/')}}/css/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/')}}/css/theme.css">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/front/')}}/css/style.css">
<!--[if lt IE 9]>
<script src="{{asset('/assets/front/')}}/js/html5shiv.min.js"></script>
<script src="{{asset('/assets/front/')}}/js/respond.min.js"></script>
<![endif]-->
</head>
<body>

  <?php echo View::make('common.header') ?>
  @yield('content');
  <?php echo View::make('common.footer') ?>
</div>
<script src="{{asset('/assets/front/')}}/js/jquery.min.js"></script> 
<script src="{{asset('/assets/front/')}}/js/wow.min.js"></script> 
<script src="{{asset('/assets/front/')}}/js/bootstrap.min.js"></script> 
<script src="{{asset('/assets/front/')}}/js/slick.min.js"></script> 
<script src="{{asset('/assets/front/')}}/js/jquery.li-scroller.1.0.js"></script> 
<script src="{{asset('/assets/front/')}}/js/jquery.newsTicker.min.js"></script> 
<script src="{{asset('/assets/front/')}}/js/jquery.fancybox.pack.js"></script> 
<script src="{{asset('/assets/front/')}}/js/custom.js"></script>
</body>
</html>