@extends('layouts.app')
@section('transactions')
active
@endsection
@section('content')
<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
            <br/>
            <section class="panel panel-default">
                <header class="panel-heading">
                   <strong> Purchased Bids Document </strong>
                </header>
                <form class="bs-example form-horizontal" action="{{route('storesales')}}" method="POST">
                        <div class="table-responsive">
                        <table class="table table-striped b-t b-light">


                            <thead>
                                <tr>
                                    <th width="20">S/NO</th>
                                    <th data-toggle="class">MDA</th>
                                    <th>Lot</th>
                                    <th>Lot Description</th>
                                    <th>Date/Time</th>
                                    <th>Download</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php $i = 1;?>
                                 @if(sizeof($sales) > 0)
                                    @foreach($sales as $data)

                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$data->mda_name}}</td>
                                            <td>{{$data->advertLot->lot_no}}</td>
                                            <td>{{$data->lot_description}}</td>
                                            <td>{{$data->created_at}}</td>
                                            <td><a href="{{action('SalesController@downloadPDF', $data->id)}}">Download</a> </td>
                                            <td>
                                            @foreach($data->awards as $award)
                                                @if($award->status == "awarded" || $award->status == "accepted")
                                                <a href="/contractor/awards/{{$award->id}}" class="btn btn-sm btn-success" > <i class="fa fa-trophy"></i> Award</a>
                                                @endif
                                            @endforeach
                                            </td>
                                        </tr>

                                    @endforeach
                                @else

                                    <tr>
                                        <td colspan="5">{{'No Record Found'}}</td>
                                    </tr>
                                @endif


                            </tbody>
                        </table>
                    </div>

                </section>
            </form>

        </section>
    </section>
</section>
@endsection

