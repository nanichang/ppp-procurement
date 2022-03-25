<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="app">
<head>
  <meta charset="utf-8" />
  <title>{{ 'e-Procurement' }}</title>
  <meta name="description" content="e-Procurement Services" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="shortcut icon" href=" {{ url('/favicon.ico') }}" />
  <!-- CSRF Token -->

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ url('/css/bootstrap.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ url('/css/animate.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ url('/css/font-awesome.min.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ url('/css/icon.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ url('/css/font.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ url('/css/app.css') }}" type="text/css" />
  <link rel="stylesheet" href="{{ url('/js/calendar/bootstrap_calendar.css') }}" type="text/css" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" type="text/css" />





  <style type="text/css">
    .hide {
      display: none;
    }
</style>
</head>
<body class="" >
  <section class="vbox">
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="{{ route('evaluator.dashboard') }}" class="navbar-brand">
          <img src="{{ url('/images/logo.png') }}" class="m-r-sm" alt="scale">
          <span class="hidden-nav-xs">PLBPP</span>
        </a>
        <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
          <i class="fa fa-cog"></i>
        </a>
      </div>
      <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="thumb-sm avatar pull-left">
            <?php $image = 'images/download.png' ?>

              <img src="{{ url($image) }}" alt="">
            </span>
            <b>{{ 'Evaluator' }}</b> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <li>
              <a href="{{ route('evaluatorLogout') }}" >Logout</a>
            </li>
          </ul>
        </li>
      </ul>
    </header>
    <section>
      <section class="hbox stretch">
        <!-- .aside -->
        <aside class="bg-black aside-md hidden-print hidden-xs" id="nav">
          <section class="vbox">
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                <div class="clearfix wrapper dk nav-user hidden-xs">
                  <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="thumb avatar pull-left m-r">
                        <img src="{{ url($image)}}" class="dker" alt="">
                        <i class="on md b-black"></i>
                      </span>
                      <span class="hidden-nav-xs clear">
                        <span class="block m-t-xs">
                          <strong class="font-bold text-lt">{{ 'Evaluator' }}</strong>
                          <b class="caret"></b>
                        </span>
                        <span class="text-muted text-xs block">{{ 'Evaluator' }}</span>
                      </span>
                    </a>
                    <!--
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                      <li class="divider"></li>
                      <li>
                        <a href="{{ route('logout') }}" >Logout</a>
                      </li>
                    </ul>-->
                  </div>
                </div>
                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Pre Bidding Excercise</div>
                  <ul class="nav nav-main" data-ride="collapse">
                                       

                    <li class="@yield('evaluator')">
                      <a href="{{ route('evaluator.dashboard') }}" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text @yield('evaluator')"></i>
                          <i class="i i-circle-sm text-active @yield('evaluator')"></i>
                        </span>
                        <i class="i i-lab icon">
                        </i>
                        <span class="font-bold">Dashboard</span>
                      </a>
                      
                    </li>

                    <li  class="@yield('openbids')">
                      <a href="{{ route('evaluator.openbids') }}" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Open Bids</span>
                      </a>

                    </li>

                    <li  class="@yield('comments')">
                      <a href="{{ route('evaluator.comments') }}" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Comments</span>
                      </a>
                      
                    </li>
                    <li  class="@yield('awards')">
                      <a href="{{ route('evaluator.awards') }}" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-lab icon">
                        </i>
                        <span class="font-bold">Awards</span>
                      </a>
                      
                    </li>
                  </ul>
                  <div class="line dk hidden-nav-xs"></div>
                </nav>
                <!-- / nav -->
              </div>
            </section>

            <footer class="footer hidden-xs no-padder text-center-nav-xs">
              <a href="{{ route('logout') }}" class="btn btn-icon icon-muted btn-inactive pull-right m-l-xs m-r-xs hidden-nav-xs">
                <i class="i i-logout"></i>
              </a>
              <a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs">
                <i class="i i-circleleft text"></i>
                <i class="i i-circleright text-active"></i>
              </a>
            </footer>
          </section>
        </aside>
        <!-- /.aside -->
        <section id="content">
          @yield('content')
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
        </section>
      </section>
    </section>
  </section>
  <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- Bootstrap -->
  <script src="{{ url('js/bootstrap.js') }}"></script>
  <!-- App -->
  <script src="{{ url('js/app.js') }}"></script>
  <script src="{{ url('js/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ url('js/charts/easypiechart/jquery.easy-pie-chart.js') }}"></script>
  <script src="{{ url('js/charts/sparkline/jquery.sparkline.min.js') }}"></script>
  <script src="{{ url('js/charts/flot/jquery.flot.min.js') }}"></script>
  <script src="{{ url('js/charts/flot/jquery.flot.tooltip.min.js') }}"></script>
  <script src="{{ url('js/charts/flot/jquery.flot.spline.js') }}"></script>
  <script src="{{ url('js/charts/flot/jquery.flot.pie.min.js') }}"></script>
  <script src="{{ url('js/charts/flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ url('js/charts/flot/jquery.flot.grow.js') }}"></script>
  <script src="{{ url('js/charts/flot/demo.js') }}"></script>

  <script src="{{ url('js/calendar/bootstrap_calendar.js') }}"></script>
  <script src="{{ url('js/calendar/demo.js') }}"></script>

  <script src="{{ url('js/sortable/jquery.sortable.js') }}"></script>


  <script>
    @if(Session::has('message'))
      var type = "{{ Session::get('alert-type', 'info') }}";
      switch(type){
        case 'info':
          toastr.info("{{ Session::get('message') }}");
          break;

        case 'warning':
          toastr.warning("{{ Session::get('message') }}");
          break;

        case 'success':
          toastr.success("{{ Session::get('message') }}");
          break;

        case 'error':
          toastr.error("{{ Session::get('message') }}");
          break;
    }
    @endif
</script>



</body>
</html>
