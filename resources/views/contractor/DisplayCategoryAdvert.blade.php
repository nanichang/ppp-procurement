@extends('layouts.app')
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
                <?php //dd($adverts) ?>
                @if(sizeof($adverts) > 0)
              {{'List of '.$adverts[0]->category_name.' Adverts'}}
              @endif
            </header>

            <form class="bs-example form-horizontal" action="{{route('deletePDFName')}}" method="POST">
                <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>

                                <th width="20">SNO</th>
                                <th data-toggle="class">MDA</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Tender Document</th>
                                 <th>Closing Date</th>
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
                                        <td>{{$advert->mda_name}}</td>
                                        <td>{{$advert->description}}</td>
                                        <td>{{$advert->lot_amount}}</td>
                                        <td>
                                            <a href="{{ asset($advert->tender_document) }}">
                                            <span class="fa-stack fa-sm"> <i class="fa fa-circle fa-stack-2x text-info"></i><i class="fa fa-search fa-stack-1x text-white"></i></span>
                                            </a>
                                        </td>
                                        <td>{{$advert->bid_opening_date}}</td>
                                        <td><i class="i i-circle-sm {{$advert->status}}"></i></td>
                                        <td>
                                            <?php $link = ($advert->status == 'text-success-dk') ? action($advert->route, $advert->advert_id) : '#' ?>
                                            <a href="{{$link}}" class="active" ><span class="fa-stack fa-sm"> <i class="fa fa-circle fa-stack-2x text-info"></i><i class="fa fa-search fa-stack-1x text-white"></i></span></a>
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
