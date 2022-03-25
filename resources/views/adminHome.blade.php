@extends('layouts.admin')
@section('dashboard')
active
@endsection
@section('content')
<section class="hbox stretch">
    <section>
        <section class="vbox">
        <section class="scrollable padder">              
            <section class="row m-b-md">
            <div class="col-sm-6">
                <h3 class="m-b-xs text-black">Dashboard</h3>
                <small>Welcome back, {{ Auth::user()->name }}</small>
            </div>
           
            </section>
            <div class="row">
            <div class="col-sm-6">
                <div class="panel b-a">
                <div class="row m-n">
                    <div class="col-md-6 b-b b-r">
                    <a href="{{ route('getMdas')}}" class="block padder-v hover">
                        <span class="i-s i-s-2x pull-left m-r-sm">
                        <i class="i i-hexagon2 i-s-base text-danger hover-rotate"></i>
                        <i class="i i-plus2 i-1x text-white"></i>
                        </span>
                        <span class="clear">
                        <span class="h3 block m-t-xs text-danger">{{ $listMdas->count() }}</span>
                        <small class="text-muted text-u-c">Registered MDAs</small>
                        </span>
                    </a>
                    </div>
                    <div class="col-md-6 b-b">
                    <a href="{{ route('contractorReport')}}" class="block padder-v hover">
                        <span class="i-s i-s-2x pull-left m-r-sm">
                        <i class="i i-hexagon2 i-s-base text-success-lt hover-rotate"></i>
                        <i class="i i-users2 i-sm text-white"></i>
                        </span>
                        <span class="clear">
                        <span class="h3 block m-t-xs text-success">{{ $registeredcontractors }}</span>
                        <small class="text-muted text-u-c">Contractors</small>
                        </span>
                    </a>
                    </div>
                    <div class="col-md-6 b-b b-r">
                    <a href="#" class="block padder-v hover">
                        <span class="i-s i-s-2x pull-left m-r-sm">
                        <i class="i i-hexagon2 i-s-base text-info hover-rotate"></i>
                        <i class="i i-location i-sm text-white"></i>
                        </span>
                        <span class="clear">
                        <span class="h3 block m-t-xs text-info">{{ $activeAdverts->count() }}</span>
                        <small class="text-muted text-u-c">Pubished Adverts</small>
                        </span>
                    </a>
                    </div>
                    <div class="col-md-6 b-b">
                    <a href="#" class="block padder-v hover">
                        <span class="i-s i-s-2x pull-left m-r-sm">
                        <i class="i i-hexagon2 i-s-base text-primary hover-rotate"></i>
                        <i class="i i-alarm i-sm text-white"></i>
                        </span>
                        <span class="clear">
                        <span class="h3 block m-t-xs text-primary">{{ $totalBids }}</span>
                        <small class="text-muted text-u-c">Bids Submitted</small>
                        </span>
                    </a>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="panel b-a">
                <div class="panel-heading no-border bg-primary lt text-center">
                    <a href="#">
                    Published adverts based on category
                    </a>
                </div>
                <div class="padder-v text-center clearfix">                            
                    <div class="col-xs-4 b-r">
                    <div class="h3 font-bold">{{$constructions}}</div>
                    <small class="text-muted">Works</small>
                    </div>
                    <div class="col-xs-4 b-r">
                    <div class="h3 font-bold">{{$consultancy}}</div>
                    <small class="text-muted">Services</small>
                    </div>
                    <div class="col-xs-4">
                    <div class="h3 font-bold">{{$supplies}}</div>
                    <small class="text-muted">Goods</small>
                    </div>
                </div>
                </div>
            </div>
  
            </div>

            <div class="row">
            <!-- <div class="col-md-6">
                <section class="panel panel-default">
                <header class="panel-heading font-bold"><b>Graphical Analysis 2017 PBPP</b></header>
                <div class="panel-body">
                    <div id="admin-flot-bar"  style="height:200px"></div>
                </div>                  
                </section>
            </div> -->

            <div class="col-md-6">
                <section class="panel panel-default">
                <header class="panel-heading"><b>Registration Statistics | Real-Time Update</b></header>
                <div class="panel-body text-center">    
                    <div class="text-xs">
                        <i class="fa fa-circle text-info"></i> Complete Registration
                        <i class="fa fa-circle text-muted"></i> Incomplete Registration
                    </div>    
                    <div class="line pull-in"></div>      
                    <div class="sparkline inline" data-type="pie" data-height="154" data-slice-colors="['#1ccacc','#f2f2f2']">{{$piechart}}, {{360-$piechart}}</div>
                    
                </div>
                </section>
            </div>


            </div>
        </section>
        </section>
    </section>
    <!-- side content -->
    
    <!-- / side content -->
    </section>
@endsection
