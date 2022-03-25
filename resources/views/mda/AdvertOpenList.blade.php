@extends(getUserRole() == 'mda' ? 'layouts.mda' : 'layouts.admin')
@section('advertlists')
active
@endsection
@section('content')

<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
          <br/>

        <section class="panel panel-info">
            <header class="panel-heading">
              Advert Lists
            </header>
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach()
                </div>
             @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p><b>{{ $message }}</b></p>
                </div>
            @endif
            <form class="bs-example form-horizontal" action="{{route('deletePDFName')}}" method="POST">
                <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>

                                <th width="20"></th>
                                <th data-toggle="class">MDA</th>
                                <th>Description</th>
                                <th>Budget Year</th>
                                <th>Bid Opening Date</th>
                                 <th>Closing Date</th>
                                <th>Status</th>
                                <th>Preview</th>
                                <th>Open</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @if(sizeof($adverts) > 0)
                                @foreach($adverts as $advert)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ getMdaName($advert->mda_id)->name }}</td>
                                        <td>{{$advert->advert_plan_desc}}</td>
                                        <td>{{$advert->budget_year}}</td>
                                        <td>{{$advert->bid_opening_date}}</td>
                                        <td>{{$advert->closing_date}}</td>
                                        <?php
                                            $route = $advert->bid_opening_date > \Carbon\Carbon::now()->isoFormat('Y-m-d') ?  'PlanAdvertController@show' : 'PlanAdvertController@show';

                                        ?>
                                        <?php $status;
                                        if($advert->approval_status == 1){ $status = 'text-success-dk'; }else { $status = 'text-danger-dk';} ?>
                                        <td><i class="i i-circle-sm {{$status}}"></i></td>
                                        <td>
                                            <?php $link = ($status == 'text-success-dk') ? action($route, $advert->id) : action($route, $advert->id) ?>
                                            <a href="{{$link}}" class="active" ><span class="fa-stack fa-sm"> <i class="fa fa-circle fa-stack-2x text-info"></i><i class="fa fa-search fa-stack-1x text-white"></i></span></a>
                                        </td>
                                        <td><a href="{{action('MDAController@viewAdvertOpeningById', $advert->id )}}" class="active" ><span class="fa-stack fa-sm"> <i class="fa fa-circle fa-stack-2x text-info"></i><i class="fa fa-search fa-stack-1x text-white"></i></span></a></td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">NO RECORD FOUND</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                </form>
         </section>
      </section>
    </section>
  </section>

@endsection
