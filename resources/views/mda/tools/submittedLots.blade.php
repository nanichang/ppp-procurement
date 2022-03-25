@extends(getUserRole() == 'mda' ? 'layouts.mda' : 'layouts.admin')
@section('mda')
    active
@endsection
@section('content')

<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
          <br/>

        <section class="panel panel-info">
                    <header class="panel-heading">
                    <div style="float: left;">Viewing all Open Bids for {{$planAdvert->name}}</div>
                    <div style="float: right;">
                        <form method="GET">
                            <select name="advert_lot_id" class="form-control" style="display: inline; width: auto;">
                                    <option value="0" {{$advert_lot_id == 0 ? 'selected="selected"': ''}}>All Records</option>
                                    @foreach($advertLots as $plan)
                                        <option value="{{ $plan->id }}" {{$advert_lot_id == $plan->id ? 'selected="selected"': ''}}>{{$plan->package_no}}//{{$plan->lot_no}}</option>
                                    @endforeach
                            </select>
                            <input type="hidden" value="{{$planAdvert->id}}" name="advert_id">
                            <button class="btn btn-sm btn-primary">Filter by Lot</button>
                        </form>
                    </div>
                    <div style="clear: both;"></div>
                </header>

            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th width="20"></th>
                            <th>Contractor</th>
                            <th>Project</th>
                            <th>Lot</th>
                            <th data-toggle="class">Tender Fee</th>
                            <th data-toggle="class">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @if(sizeof($sales) > 0)
                            @foreach($sales as $sale)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$sale->contractor_name}}</td>
                                    <td>{{$sale->advert_name}}</td>
                                    <td>{{$sale->advertLot->package_no}}//{{$sale->advertLot->lot_no}}</td>
                                    <td>{{number_format($sale->amount, 2) }}</td>
                                    <td>
                                        <a href="{{ route('viewSingleSubmittedLot', ['advert_lot_id' => $sale->advert_lot_id, 'mda_id' => $sale->mda_id, 'contractor_id' => $sale->contractor_id, 'sale_id' => $sale->id]) }}" class="btn btn-s-md btn-primary btn-rounded"><i class="fa fa-eye"></i> View Details</a>
                                        @if($sale->is_awarded == 1)
                                        <!-- <i style="font-size: 1.8em;color: blue;" class="fa fa-trophy"></i> -->
                                        @endif
                                    </td>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8">NO RECORD FOUND</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>    

         </section>

      </section>
    </section>
  </section>

@endsection
