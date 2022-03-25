@extends('layouts.admin')
@section('bidadverts')
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

                                <th width="20">SNO</th>
                                <th>Advert Type</th>
                                <th>Advert Title</th>
                                <th>Advert Mode</th>
                                <!-- <th>Amount</th> -->
                                <th>Status</th>
                                <th>Preview</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @if(sizeof($adverts) > 0)
                                @foreach($adverts as $advert)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$advert->advert_type}}</td>
                                        <td>{{$advert->description}}</td>
                                        <td>{{$advert->advert_mode}}</td>
                                        <!-- <td>{{$advert->amount}}</td> -->
                                        <?php $status;
                                        if($advert->status=='active'){ $status = 'text-success-dk'; } elseif($advert->status == 'disabled'){$status = 'text-danger-dk' ;} else { $status = 'text-warning-dk';} ?>
                                        <td><i class="i i-circle-sm {{$status}}"></i></td>
                                        <td>
                                            <a href="{{action('PlanAdvertController@show', $advert->id )}}" class="active" ><span class="fa-stack fa-sm"> <i class="fa fa-circle fa-stack-2x text-info"></i><i class="fa fa-search fa-stack-1x text-white"></i></span></a>
                                        </td>
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

@endsection
