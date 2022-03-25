@extends('layouts.admin')
@section('bidopening')
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

            <form class="bs-example form-horizontal" action="{{route('deletePDFName')}}" method="POST">
                <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>

                                <th width="20">SNO</th>
                                <th data-toggle="class">MDA</th>
                                <th>Year</th>
                                <th>Bid Opening</th>
                                <th>Advert Title</th>
                                <th>Preview </th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @if(sizeof($adverts) > 0)
                                @foreach($adverts as $advert)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$advert->user->name}}</td>
                                        <td>{{$advert->budget_year}}</td>
                                        <td>{{$advert->bid_opening_date}}</td>
                                        <td>{{$advert->name}}</td>
                                        <td>
                                            <a href="{{action('MDAController@viewAdvertOpeningById', $advert->id )}}" class="active" ><span class="fa-stack fa-sm"> <i class="fa fa-circle fa-stack-2x text-info"></i><i class="fa fa-search fa-stack-1x text-white"></i></span></a>
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
