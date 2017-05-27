<!DOCTYPE html>
<html lang="en" class="wide wow-animation smoothscroll scrollTo">
  <head>
    <!-- Site Title-->
    <title>Register</title>
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
          <!-- Register-->
          <section>
            <div class="shell">
              <div class="range">
                <div class="section-110 section-cover range range-xs-center range-xs-middle">
                  <div class="cell-xs-8 cell-sm-6 cell-md-4">
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
   },2500);
   $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });

</script>
                    <div class="panel section-34 section-sm-41 inset-left-20 inset-right-20 inset-sm-left-20 inset-sm-right-20 inset-lg-left-30 inset-lg-right-30 bg-white shadow-drop-md">
                                <!-- Icon Box Type 4--><span class="icon icon-circle icon-bordered icon-lg icon-default mdi mdi-account-multiple-outline"></span>
                                <div>
                                  <div class="offset-top-24 text-darker big text-bold">Create your account</div>
                                  <p class="text-extra-small text-dark offset-top-4">All fields are required</p>
                                </div>
                      <!-- RD Mailform-->
                      <form data-form-output="form-output-global" data-form-type="contact" method="post" action="{{ url('/register') }}" class="text-left offset-top-30">
                      {{ csrf_field() }}
                        <div class="form-group">
                          <div class="input-group input-group-sm"><span class="input-group-addon input-group-addon-inverse"><span class="input-group-icon mdi mdi-barcode"></span></span>
                            <input id="schoolID" placeholder="Your School ID" type="text" name="studentID" data-constraints="@Required" class="form-control" value="{{ old('studentID') }}">
                          </div>
                        </div>
                        <div class="form-group offset-top-20">
                          <div class="input-group input-group-sm"><span class="input-group-addon input-group-addon-inverse"><span class="input-group-icon mdi mdi-account"></span></span>
                            <input id="firstName" placeholder="Your First Name" type="text" name="firstName" data-constraints="@Required" class="form-control" value="{{ old('firstName') }}">
                          </div>
                        </div>
                        <div class="form-group offset-top-20">
                          <div class="input-group input-group-sm"><span class="input-group-addon input-group-addon-inverse"><span class="input-group-icon mdi mdi-account-outline"></span></span>
                            <input id="lastName" placeholder="Your Last Name" type="text" name="lastName" data-constraints="@Required" class="form-control" value="{{ old('lastName') }}">
                          </div>
                        </div>
                        <div class="form-group offset-top-20">
                          <div class="input-group input-group-sm"><span class="input-group-addon input-group-addon-inverse"><span class="input-group-icon mdi mdi-lock-open-outline"></span></span>
                            <input id="login-password" placeholder="Password" type="password" name="password" data-constraints="@Required" class="form-control">
                          </div>
                        </div>
                        <div class="form-group offset-top-20">
                          <div class="input-group input-group-sm"><span class="input-group-addon input-group-addon-inverse"><span class="input-group-icon mdi mdi-lock-outline"></span></span>
                            <input id="login-repeat-password" placeholder="Repeat your password" type="password" name="password_confirmation" data-constraints="@Required" class="form-control">
                          </div>
                        </div>
                        
                        <button type="submit" class="btn btn-xs btn-icon btn-block btn-malibu offset-top-20">Sign Up <span class="icon mdi mdi-arrow-right-bold-circle-outline"></span></button>
                      </form>
                      <div class="offset-top-30 text-sm-left text-dark text-extra-small">
                        <div class="offset-top-0">Already have an account? <a href="{{url('/login')}}" class="text-picton-blue">Sign in here</a>.</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <div class="one-page-footer">
            <p style="color: rgba(255,255,255, 0.3)" class="small">iPasabay &copy; <span id="copyright-year"></span> . </p>
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
  </body>
</html>