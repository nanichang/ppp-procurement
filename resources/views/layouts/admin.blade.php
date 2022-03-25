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
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  
  <link rel="stylesheet" type="text/css" media="screen" href="{{ url('/css/bootstrap-datetimepicker.min.css') }}"/>

  <![endif]-->
  <script>
    var base_url = '{{ url('/') }}';
  </script>
</head>
<body class="" >
  <section class="vbox">
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk">
        <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
          <i class="fa fa-bars"></i>
        </a>
        <a href="/" class="navbar-brand">
          <img src="{{ asset('/images/logo.png') }}" class="m-r-sm" alt="scale">
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
              <img src="{{ asset('/images/p0.jpg') }}" alt="...">
            </span>
            <b>{{ Auth::user()->name }}</b> <b class="caret"></b>
          </a>
          <ul class="dropdown-menu animated fadeInRight">
            <!-- <li>
              <span class="arrow top"></span>
              <a href="#">Settings</a>
            </li>
            <li>
              <a href="docs.html">Help</a>
            </li> -->

            <li>
              <a href="{{ route('logout') }}" >Logout</a>
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
                        <img src="{{ asset('/images/p0.jpg') }}" class="dker" alt="...">
                        <i class="on md b-black"></i>
                      </span>
                      <span class="hidden-nav-xs clear">
                        <span class="block m-t-xs">
                          <strong class="font-bold text-lt">{{ Auth::user()->name }}</strong>
                          <b class="caret"></b>
                        </span>
                        <span class="text-muted text-xs block">{{ Auth::user()->user_type }}</span>
                      </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">

                      <span class="arrow top hidden-nav-xs"></span>
                      <li>
                        <a href="{{ route('logout') }}" >Logout</a>
                      </li>
                    </ul>
                  </div>
                </div>


                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Pre Bidding Excercise</div>
                  <ul class="nav nav-main" data-ride="collapse">
                    <li  class="@yield('dashboard')">
                      <a href="{{ route('home') }}" class="auto">
                        <i class="i i-statistics icon">
                        </i>
                        <span class="font-bold">Dashboard</span>
                      </a>
                    </li>

                    <li class="@yield('advertlists')">
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text @yield('advertlists')"></i>
                          <i class="i i-circle-sm text-active @yield('advertlists')"></i>
                        </span>
                        <i class="i i-lab icon">
                        </i>
                        <span class="font-bold">Bid Adverts</span>
                      </a>
                      <ul class="nav dk">
                        <li  class="@yield('advertlists')">
                          <a href="{{ route('listAllAdverts') }}" class="auto">
                            <i class="i i-dot"></i>
                            <span>All Adverts</span>
                          </a>
                        </li>
                        <li class="@yield('advertlists')" >
                          <a href="{{ route('getAllAdvertsByCategory', 1) }}" class="auto">
                            <i class="i i-dot"></i>
                            <span>Construction/Works Adverts</span>
                          </a>
                        </li>
                        <li  class="@yield('advertlists')">
                          <a href="{{route('getAllAdvertsByCategory', 2)}}" class="auto">
                            <i class="i i-dot"></i>
                            <span>Consultancy/Service Adverts</span>
                          </a>
                        </li>
                        <li class="@yield('advertlists')" >
                          <a href="{{route('getAllAdvertsByCategory', 3)}}"class="auto">
                            <i class="i i-dot"></i>
                            <span>Goods/Supply Adverts</span>
                          </a>
                        </li>
                        <li class="@yield('advertlists')" >
                          <a href="{{ action('PlanAdvertController@getAllOpeningAdverts') }}" class="auto">
                            <i class="i i-dot"></i>
                            <span>Bid Opening Adverts</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <li  class="@yield('awards')">
                      <a href="/admin/awards" class="auto">
                        <i class="i i-statistics icon">
                        </i>
                        <span class="font-bold">Awards</span>
                      </a>
                    </li>
                    <li  class="@yield('getmdas')">
                      <a href="{{ route('getMdas') }}" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">MDA Accounts</span>
                      </a>

                    </li>

                    <li  class="@yield('reports')">
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text" ></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Reports</span>
                      </a>
                      <ul class="nav dk">
                        <li >
                          <a href="{{ route('contractorReport') }}" class="auto">
                            <i class="i i-dot"></i>

                            <span>Contractors</span>
                          </a>
                        </li>
                    </ul>
                    </li>

                    <li  class="@yield('reg-payment')">
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text" ></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Registration Payment</span>
                      </a>
                      <ul class="nav dk">
                        <li >
                          <a href="{{ route('contractor.registration.index') }}" class="auto">
                            <i class="i i-dot"></i>
                            <span>Contractors</span>
                          </a>
                        </li>
                    </ul>
                    </li>

                    <li class="@yield('tools')" >
                      <a href="#" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-stack icon">
                        </i>
                        <span class="font-bold">Administrative Tools</span>
                      </a>
                      <ul class="nav dk">
                         <li >
                          <a href="{{ route('procurementYear.index') }}" class="auto">
                            <i class="i i-dot @yield('tools')"></i>
                            <span>Procurement Year</span>
                          </a>
                        </li>
                         <li >
                          <a href="{{ route('procurementPlan.index') }}" class="auto">
                            <i class="i i-dot @yield('tools')"></i>
                            <span>Procurement Types</span>
                          </a>
                        </li>
                        <li >
                          <a href="{{ route('fetchAdvertTypes') }}" class="auto">
                            <i class="i i-dot @yield('tools')"></i>
                            <span>Advert Types</span>
                          </a>
                        </li>
                        <li >
                          <a href="{{ route('fetchAdvertModes') }}" class="auto">
                            <i class="i i-dot @yield('tools')"></i>
                            <span>Advert Mode</span>
                          </a>
                        </li>
                        <!--
                         <li >
                          <a href="{{ route('fetchBusinessCategories') }}" class="auto">
                            <i class="i i-dot @yield('tools')"></i>
                            <span>Business Category</span>
                          </a>
                        </li>
                        -->
                        <li >
                          <a href="{{ route('evaluator.index') }}" class="auto">
                            <i class="i i-dot @yield('tools')"></i>
                            <span>Evaluators</span>
                          </a>
                        </li>
                        <li >
                          <a href="{{ route('fetchBusinessSubCategories') }}" class="auto">
                            <i class="i i-dot @yield('tools')"></i>
                            <span>Business Sub Category</span>
                          </a>
                        </li>
                        <li >
                          <a href="{{ route('getEligibility') }}" class="auto">
                            <i class="i i-dot @yield('tools')"></i>

                            <span>Eligibility</span>
                          </a>
                        </li>
                        <li >
                          <a href="{{ route('getOwnership') }}" class="auto">
                            <i class="i i-dot @yield('tools')"></i>

                            <span>Ownership Structure</span>
                          </a>
                        </li>
                        <li >
                          <a href="{{ route('getEquipments') }}" class="auto">
                            <i class="i i-dot @yield('tools')"></i>

                            <span>Equipments Type</span>
                          </a>
                        </li>
                        <li >
                          <a href="{{ route('getFees') }}" class="auto">
                            <i class="i i-dot"></i>

                            <span>Registration Fee</span>
                          </a>
                        </li>
                        <li >
                          <a href="{{ route('qualifications') }}" class="auto">
                            <i class="i i-dot"></i>

                            <span>Qualifications</span>
                          </a>
                        </li>
                    </ul>
                    </li>

                    <li >
                      <a href="{{ route('logout') }}" class="auto">
                        <span class="pull-right text-muted">
                          <i class="i i-circle-sm-o text"></i>
                          <i class="i i-circle-sm text-active"></i>
                        </span>
                        <i class="i i-lab icon">
                        </i>
                        <span class="font-bold">Log Out</span>
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- Bootstrap -->
  <script src="{{ asset('js/bootstrap.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
  <!-- App -->
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/slimscroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ asset('js/charts/easypiechart/jquery.easy-pie-chart.js') }}"></script>
  <script src="{{ asset('js/charts/sparkline/jquery.sparkline.min.js') }}"></script>
  <script src="{{ asset('js/charts/flot/jquery.flot.min.js') }}"></script>
  <script src="{{ asset('js/charts/flot/jquery.flot.tooltip.min.js') }}"></script>
  <script src="{{ asset('js/charts/flot/jquery.flot.spline.js') }}"></script>
  <script src="{{ asset('js/charts/flot/jquery.flot.pie.min.js') }}"></script>
  <script src="{{ asset('js/charts/flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('js/charts/flot/jquery.flot.grow.js') }}"></script>
  <script src="{{ asset('js/charts/flot/demo.js') }}"></script>

  <script src="{{ asset('js/calendar/bootstrap_calendar.js') }}"></script>
  <script src="{{ asset('js/calendar/demo.js') }}"></script>

  <script src="{{ asset('js/sortable/jquery.sortable.js') }}"></script>
  <script src="{{ asset('js/app.plugin.js') }}"></script>
  <script>
  $( document ).ready(function() {
    $.ajaxSetup({
      headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      }
    })
  });
  </script>

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
