@extends('layouts.app')
@section('dashboard')
active
@endsection
@section('content')
<style>
  section.panel-body.slim-scroll {
    ovrflow: auto !important;
    hieight: 150px !important;
  }
</style>
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
                    <a href="#" class="block padder-v hover">
                        <span class="i-s i-s-2x pull-left m-r-sm">
                        <i class="i i-hexagon2 i-s-base text-danger hover-rotate"></i>
                        <i class="i i-plus2 i-1x text-white"></i>
                        </span>
                        <span class="clear">
                        <span class="h3 block m-t-xs text-danger">{{$adverts}}</span>
                        <small class="text-muted text-u-c">Adverts Published</small>
                        </span>
                    </a>
                    </div>
                    <div class="col-md-6 b-b">
                    <a href="#" class="block padder-v hover">
                        <span class="i-s i-s-2x pull-left m-r-sm">
                        <i class="i i-hexagon2 i-s-base text-success-lt hover-rotate"></i>
                        <i class="i i-users2 i-sm text-white"></i>
                        </span>
                        <span class="clear">
                        <span class="h3 block m-t-xs text-success">{{sizeof($submittedBids)}}</span>
                        <small class="text-muted text-u-c">Bids Submitted</small>
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
                        <span class="h3 block m-t-xs text-info">{{sizeof($closingBids)}}</span>
                        <small class="text-muted text-u-c">Bids Closing in 7 Days</small>
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
                        <span class="h3 block m-t-xs text-primary" id="completedPercentage">{{$percent_status['percentage']}}%</span>
                        <small class="text-muted text-u-c">Registration Progress</small>
                        </span>
                    </a>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <div class="panel b-a">
                <div class="panel-heading no-border bg-primary lt text-center">
                    <a href="#">
                    <i class="fa fa-briefcase fa fa-3x m-t m-b text-white"></i>
                    </a>
                </div>
                <div class="padder-v text-center clearfix">                            
                    <div class="col-xs-12">
                    <div class="h3 font-bold">{{$jobs['constructions']}}</div>
                    <small class="text-muted">Construction | Works</small>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <div class="panel b-a">
                <div class="panel-heading no-border bg-info lter text-center">
                    <a href="#">
                    <i class="fa fa-briefcase fa fa-3x m-t m-b text-white"></i>
                    </a>
                </div>
                <div class="padder-v text-center clearfix">                            
                    <div class="col-xs-12">
                    <div class="h3 font-bold">{{$jobs['consultancy']}}</div>
                    <small class="text-muted">Consultancy | Services</small>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6">
                <div class="panel b-a">
                <div class="panel-heading no-border bg-primary lt text-center">
                    <a href="#">
                    <i class="fa fa-briefcase fa fa-3x m-t m-b text-white"></i>
                    </a>
                </div>
                <div class="padder-v text-center clearfix">                            
                    <div class="col-xs-12">
                    <div class="h3 font-bold">{{$jobs['supplies']}}</div>
                    <small class="text-muted">Goods | Supplies</small>
                    </div>
                </div>
                </div>
            </div>
            </div>

            <div class="row">

            <div class="col-md-6"> <!-- See portlet.html -->
              <section class="panel panel-success portlet-item">
                <header class="panel-heading">
                <b>Business Registration Status</b>
                </header>
                <ul class="list-group alt">
                  <li class="list-group-item">
                    <div class="media">
                      <span class="pull-left thumb-sm"><img src="{{ asset('/images/p0.jpg') }}" alt="..." class="img-circle"></span>
                      @if($percent_status['companies'])
                        <div class="pull-right text-success m-t-sm">
                         @else 
                          <div class="pull-right text-muted m-t-sm"> 
                         @endif
                     
                        <i class="fa fa-circle"></i>
                      </div>
                      <div class="media-body">
                        <div><a href="#">Company Identification</a></div>
                        @if($percent_status['companies'])
                        <small class="text-muted">Completed</small>
                         @else 
                          <small class="text-muted">Not Completed</small>
                         @endif
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="media">
                      <span class="pull-left thumb-sm"><img src="{{ asset('/images/p0.jpg') }}" alt="..." class="img-circle"></span>
                        @if($percent_status['compliances'])
                        <div class="pull-right text-success m-t-sm">
                         @else 
                          <div class="pull-right text-muted m-t-sm"> 
                         @endif
                        <i class="fa fa-circle"></i>
                      </div>
                      <div class="media-body">
                        <div><a href="#">Business Registration & Compliance</a></div>
                        @if($percent_status['compliances'])
                        <small class="text-muted">Completed</small>
                         @else 
                          <small class="text-muted">Not Completed</small>
                         @endif
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="media">
                      <span class="pull-left thumb-sm"><img src="{{ asset('/images/p0.jpg') }}" alt="..." class="img-circle"></span>
                      @if($percent_status['directors'])
                        <div class="pull-right text-success m-t-sm">
                         @else 
                          <div class="pull-right text-muted m-t-sm"> 
                         @endif
                        <i class="fa fa-circle"></i>
                      </div>
                      <div class="media-body">
                        <div><a href="#">Company Board of Directors</a></div>
                        @if($percent_status['directors'])
                        <small class="text-muted">Completed</small>
                         @else 
                          <small class="text-muted">Not Completed</small>
                         @endif
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="media">
                      <span class="pull-left thumb-sm"><img src="{{ asset('/images/p0.jpg') }}" alt="..." class="img-circle"></span>
                      @if($percent_status['categories'])
                        <div class="pull-right text-success m-t-sm">
                         @else 
                          <div class="pull-right text-muted m-t-sm"> 
                         @endif
                        <i class="fa fa-circle"></i>
                      </div>
                      <div class="media-body">
                        <div><a href="#">Business Category</a></div>
                        @if($percent_status['categories'])
                        <small class="text-muted">Completed</small>
                         @else 
                          <small class="text-muted">Not Completed</small>
                         @endif
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="media">
                      <span class="pull-left thumb-sm"><img src="{{ asset('/images/p0.jpg') }}" alt="..." class="img-circle"></span>
                      @if($percent_status['personnels'])
                        <div class="pull-right text-success m-t-sm">
                         @else 
                          <div class="pull-right text-muted m-t-sm"> 
                         @endif
                        <i class="fa fa-circle"></i>
                      </div>
                      <div class="media-body">
                        <div><a href="#">Company Staff/Personnel</a></div>
                        @if($percent_status['personnels'])
                        <small class="text-muted">Completed</small>
                         @else 
                          <small class="text-muted">Not Completed</small>
                         @endif
                      </div>
                    </div>
                  </li>

                  <li class="list-group-item">
                    <div class="media">
                      <span class="pull-left thumb-sm"><img src="{{ asset('/images/p0.jpg') }}" alt="..." class="img-circle"></span>
                      @if($percent_status['jobs'])
                        <div class="pull-right text-success m-t-sm">
                         @else 
                          <div class="pull-right text-muted m-t-sm"> 
                         @endif
                        <i class="fa fa-circle"></i>
                      </div>
                      <div class="media-body">
                        <div><a href="#">Projects Executed</a></div>
                        @if($percent_status['jobs'])
                        <small class="text-muted">Completed</small>
                         @else 
                          <small class="text-muted">Not Completed</small>
                         @endif
                      </div>
                    </div>
                  </li>

                  <li class="list-group-item">
                    <div class="media">
                      <span class="pull-left thumb-sm"><img src="{{ asset('/images/p0.jpg') }}" alt="..." class="img-circle"></span>
                      @if($percent_status['finances'])
                        <div class="pull-right text-success m-t-sm">
                         @else 
                          <div class="pull-right text-muted m-t-sm"> 
                         @endif
                        <i class="fa fa-circle"></i>
                      </div>
                      <div class="media-body">
                        <div><a href="#">Company Financial Statements</a></div>
                        @if($percent_status['finances'])
                        <small class="text-muted">Completed</small>
                         @else 
                          <small class="text-muted">Not Completed</small>
                         @endif
                      </div>
                    </div>
                  </li>

                  <li class="list-group-item">
                    <div class="media">
                      <span class="pull-left thumb-sm"><img src="{{ asset('/images/p0.jpg') }}" alt="..." class="img-circle"></span>
                      @if($percent_status['machines'])
                        <div class="pull-right text-success m-t-sm">
                         @else 
                          <div class="pull-right text-muted m-t-sm"> 
                         @endif
                        <i class="fa fa-circle"></i>
                      </div>
                      <div class="media-body">
                        <div><a href="#">Equipment/Machineries</a></div>
                        @if($percent_status['machines'])
                        <small class="text-muted">Completed</small>
                         @else 
                          <small class="text-muted">Not Completed</small>
                         @endif
                      </div>
                    </div>
                  </li>

                  <li class="list-group-item">
                    <div class="media">
                      <span class="pull-left thumb-sm"><img src="{{ asset('/images/p0.jpg') }}" alt="..." class="img-circle"></span>
                      @if($percent_status['uploads'])
                        <div class="pull-right text-success m-t-sm">
                         @else 
                          <div class="pull-right text-muted m-t-sm"> 
                         @endif
                        <i class="fa fa-circle"></i>
                      </div>
                      <div class="media-body">
                        <div><a href="#">Document Uploads</a></div>
                        @if($percent_status['uploads'])
                        <small class="text-muted">Completed</small>
                         @else 
                          <small class="text-muted">Not Completed</small>
                         @endif
                      </div>
                    </div>
                  </li>
                  
                </ul>
              </section>
            </div>

            <div class="col-md-6">

              <section class="panel panel-info portlet-item">
                <header class="panel-heading">                    
                <b>Recently Advertised Bids</b>
                </header>
                  <section class="panel-body slim-scroll" data-height="230px" data-size="10px">
                    @if(sizeof($activeAdverts) >0)
                      @foreach($activeAdverts as $advert)
                        <article class="media">
                            <div class="pull-left">
                              <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x text-info"></i>
                                <i class="fa fa-file-o fa-stack-1x text-white"></i>
                              </span>
                            </div>              
                            <div class="media-body">
                            <div class="pull-right media-xs text-center text-muted">
                                <?php  $date = Carbon\Carbon::parse($advert->advert_publish_date);  $newDate = $date->isoFormat('MMM Do'); ?>
                                <strong class="h4">{{explode(" ", $newDate)[1]}}</strong><br>
                                <small class="label bg-light">{{explode(" ", $newDate)[0]}}</small>
                            </div>
                            <a href="{{route('returnAds', $advert->id)}}" id="adLink" class="h4 block m-t-xs disabled">{{$advert->name}}</a>
                            <small class="block m-t-xs">{{$advert->user->name}}</small>
                            <small class="block m-t-sm">{{$advert->introduction}}</small>
                            </div>
                        </article>
                      @endforeach
                    @else
                      <small class="block m-t-sm">NO RECORD FOUND</small>
                    @endif
                  </section>
                </section>
            
            </div>

            <div class="col-md-6">
                <section class="panel panel-primary portlet-item">
                <header class="panel-heading">
                <b>Bids Submitted</b>
                </header>
                <section class="panel-body slim-scroll" data-height="230px" data-size="10px">
                   @if(sizeof($submittedBids) >0)
                      @foreach($submittedBids as $bid)
                        <article class="media">
                          <div class="pull-left">
                              <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x text-info"></i>
                                <i class="fa fa-file-o fa-stack-1x text-white"></i>
                              </span>
                            </div>                
                            <div class="media-body">
                              <div class="pull-right media-xs text-center text-muted">
                                <?php $date = Carbon\Carbon::parse($bid->created_at);  $newDate = $date->isoFormat('MMM Do'); ?>
                                <strong class="h4">{{explode(" ", $newDate)[1]}}</strong><br>
                                <small class="label bg-light">{{explode(" ", $newDate)[0]}}</small>
                              </div>
                              <a href="{{action('AdvertController@getAdvertById', $bid->advert_id)}}" class="h4 disabled">{{$bid->advert_name}}</a>
                              <small class="block">{{$bid->mda_name}}</small>
                              <small class="block m-t-sm">{{$bid->lot_description}}</small>
                            </div>
                        </article>
                      @endforeach
                    @else
                      <small class="block m-t-sm">NO RECORD FOUND</small>
                    @endif
                  </section>
                
              </section>
            </div>

            </div>
        </section>
        </section>
    </section>
    <!-- side content -->
    
    <!-- / side content -->
    </section>
</section>
<script>

  window.addEventListener('load', function () {
     let span = document.getElementById('completedPercentage')
   return (Number(span.innerHTML.replace('%', '')) < 100 ) ? $('.disabled').removeAttr('href'): null;
    
   });

</script>
@endsection

