<!DOCTYPE html>
<html lang="en" class="wide wow-animation smoothscroll scrollTo">
  <head>
    <!-- Site Title-->
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="keywords" content="intense web design multipurpose template">
    <meta name="date" content="Dec 26">
          <link rel="icon" href="{{asset('/favicon.ico')}}" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat:400,700%7CLato:300,300italic,400,700,900%7CYesteryear">
    <link rel="stylesheet" href="css/style.css">
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->
  </head>
  <style type="text/css">
    .bgmoto{background: #466368;
      background: linear-gradient(to right bottom, #648880, #293f50);
    }
  </style>
  <body>
    <!-- Page-->
    <div class="page text-center">
      <!-- Page Content-->
      <main class="page-content bgmoto">
        <div class="one-page">
          <div class="one-page-header">
            <!--Navbar Brand-->
            <div class="rd-navbar-brand"><a href="index-2.html"><img style='margin-top: -5px;margin-left: -15px;' width='138' height='31' src='images/intense/logo-light.png' alt=''/></a></div>
          </div>
          <!-- Login-->
          <section>
            <div class="shell">
              <div class="range">
                <div class="section-110 section-cover range range-xs-center range-xs-middle">

                  <div class="cell-xs-8 cell-sm-6 cell-md-4">
                    <div class="flash-message">
                  @foreach(['danger','warning','success','info'] as $message)
                   @if (Session::has('alert-'. $message))
                    <strong><p class="alert alert-{{$message}}">{{Session::get('alert-'.$message)}} <a href="#" class="close" data-dismiss="alert" aria-label="close"></a></p></strong>
                    @endif
                  @endforeach
                </div>
                    @if (count($errors) > 0)    
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>  
                        @endif 
  <script>
     window.setTimeout(function(){
    $(".alert-danger").fadeTo(300,0).slideUp(100,function(){
        $(this).remove();
    });
   },3000);
   $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });
   window.setTimeout(function(){
    $(".flash-message").fadeTo(500,0).slideUp(500,function(){
        $(this).remove();
    });
   },7000); 
</script>
                    <div class="panel section-34 section-sm-41 inset-left-20 inset-right-20 inset-sm-left-20 inset-sm-right-20 inset-lg-left-30 inset-lg-right-30 bg-white shadow-drop-md">
                                <!-- Icon Box Type 4--><span class="icon icon-circle icon-bordered icon-lg icon-default mdi mdi-account-multiple-outline"></span>
                                <div>
                                  <div class="offset-top-24 text-darker big text-bold">Login to your account</div>
                                  <p class="text-extra-small text-dark offset-top-4">Enter your credentials below</p>
                                </div>
                      <!-- RD Mailform-->
                      <form data-form-output="form-output-global" data-form-type="contact" method="post" action="{{ url('/login') }}" class="text-left offset-top-30">
                      {{ csrf_field() }}

                        <div class="form-group">
                          <div class="input-group input-group-sm"><span class="input-group-addon input-group-addon-inverse"><span class="input-group-icon mdi mdi-account-outline"></span></span>
                            <input id="login-your-login" placeholder="Your School ID" type="text" name="studentID" data-constraints="@Required" class="form-control">
                          </div>
                        </div>
                        <div class="form-group offset-top-20">
                          <div class="input-group input-group-sm"><span class="input-group-addon input-group-addon-inverse"><span class="input-group-icon mdi mdi-lock-open-outline"></span></span>
                            <input id="login-your-password" placeholder="Your Password" type="password" name="password" data-constraints="@Required" class="form-control">
                          </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-icon btn-block btn-malibu offset-top-20">Sign In <span class="icon mdi mdi-arrow-right-bold-circle-outline"></span></button>
                      </form>
                      <div class="offset-top-30 text-sm-left text-dark text-extra-small">
                        <div class="offset-top-0">Haven’t an account? <a href="{{url('/register')}}" class="text-picton-blue">Sign up here</a>.</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <div class="one-page-footer">
            <p style="color: rgba(255,255,255, 0.3)" class="small">iPasabay &copy; <span id="copyright-year"></span> . <a href="privacy.html">Privacy Policy</a></p>
          </div>
        </div>
      </main>
    </div>
    <!-- Global Mailform Output-->
    <div id="form-output-global" class="snackbars"></div>
    <!-- PhotoSwipe Gallery-->
    <div tabindex="-1" role="dialog" aria-hidden="true" class="pswp">
      <div class="pswp__bg"></div>
      <div class="pswp__scroll-wrap">
        <div class="pswp__container">
          <div class="pswp__item"></div>
          <div class="pswp__item"></div>
          <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
          <div class="pswp__top-bar">
            <div class="pswp__counter"></div>
            <button title="Close (Esc)" class="pswp__button pswp__button--close"></button>
            <button title="Share" class="pswp__button pswp__button--share"></button>
            <button title="Toggle fullscreen" class="pswp__button pswp__button--fs"></button>
            <button title="Zoom in/out" class="pswp__button pswp__button--zoom"></button>
            <div class="pswp__preloader">
              <div class="pswp__preloader__icn">
                <div class="pswp__preloader__cut">
                  <div class="pswp__preloader__donut"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
            <div class="pswp__share-tooltip"></div>
          </div>
          <button title="Previous (arrow left)" class="pswp__button pswp__button--arrow--left"></button>
          <button title="Next (arrow right)" class="pswp__button pswp__button--arrow--right"></button>
          <div class="pswp__caption">
            <div class="pswp__caption__center"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Java script-->
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>
  </body><!-- Google Tag Manager --><noscript><iframe src="http://www.googletagmanager.com/ns.html?id=GTM-P9FT69"height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript><script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='../../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-P9FT69');</script><!-- End Google Tag Manager -->
</html>