@extends('layouts.app')

@section('content')
<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
            <br/>
            <section class="panel panel-default">
                <header class="panel-heading">
                  <p> <strong> {{$user->first_name}} </strong> </p>
                  <p> Project Title: {{strtoupper($advert->introduction)}} </p>
                  <p> Advert Type: {{strtoupper($advert->advert_type)}} </p>
                </header>
                <form class="bs-example form-horizontal" action="{{route('storesales')}}" method="POST"> 

                    <input type="hidden" value="{{$advert->id}}" name="advertId"/>
                    <input type="hidden" name="advert_name" value="{{$advert->name}}" >
                        <input type="hidden" name="advert_introduction" value="{{$advert->advert_plan_desc}}" >
                        <input type="hidden" name="mda_id" value="{{$advert->mda_id}}" >
                        <input type="hidden" name="mda_name" value="{{$user->first_name}}" >
                        <div class="table-responsive">
                        <table class="table table-striped b-t b-light">


                            <thead>
                                <tr>
                                <th width="20"><label class="checkbox m-l m-t-none m-b-none i-checks"><input disabled type="checkbox"><i></i></label></th>
                                <th data-toggle="class">Lot</th>
                                <th>Lot Description</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody id="lots">
                            @php
                            $showTxButtons = 0;
                            $showPaymentButton = 0;
                            @endphp
                                @if(sizeof($advert->advertLots) > 0)
                                @foreach($advert->advertLots as $lot)
                                    @php
                                        $sale = null;
                                        foreach($transactions as $item){
                                            if($item->advert_lot_id == $lot->id){
                                                $sale = $item;
                                                if($sale->payment_status == 'Paid'){
                                                    $showPaymentButton++;
                                                }else{
                                                    $showTxButtons++;
                                                }
                                                break;
                                            }
                                        }
                                    @endphp
                                    <tr>
                                        <td><label class="checkbox m-l m-t-none m-b-none i-checks">
                                            <input type="checkbox" name="fids[]" value="{{$lot->id}}"
                                        @if($sale != null)
                                        disabled
                                        @endif
                                        /><i></i></label></td>
                                        <td>Lot</td>
                                        <td>{{$lot->description}}</td>
                                        <td>{{$lot->category_name}}</td>
                                        <td>{{number_format($lot->lot_amount)}}</td>
                                        <td>@if($sale != null){{strtoupper($sale->payment_status)}}@endif</td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">{{'No Lot Found'}}</td>
                                    </tr>
                                @endif


                            </tbody>
                        </table>
                    </div>
                    <div class="row" style="padding-left: 10px; padding-right: 10px;">
                    <div class="col-md-6">
                         <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
                            <!-- <a href="{{ route('newMdaAdvert') }}" class="btn btn-default">Back to Lots</a> -->
                        </div>
                        <div class="col-md-6 text-right">
                            @if($showTxButtons > 0)
                            <a href="/contractor/transactions" class="btn btn-success">Transactions</a> 
                            @endif
                            @if($showPaymentButton > 0)
                            <a href="/bids/bidDocuments" class="btn">Bid Documents</a> 
                            @endif
                            <button type="submit" id="submitBtn" disabled="disabled" class="btn btn-primary">Submit Application</button>
                        </div>
                    </div>
                    <br/>
                </section>
            </form>

        </section>
    </section>
</section>
<script>

    window.addEventListener('load', function () {
        $(document).ready(function() {
            var sumchecked = 0;
            $('#lots').on('change', 'input[type="checkbox"]', function(){
                ($(this).is(':checked')) ? sumchecked++ : sumchecked--;
                (sumchecked > 0) ? $('#submitBtn').removeAttr('disabled') : $('#submitBtn').attr('disabled', 'disabled');


            });
        });
    });

</script>


@endsection

