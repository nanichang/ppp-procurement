@extends('layouts.app')
@section('biddingdocuments')
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
                                    <th>Closing Date</th>
                                    <th>Opening Date</th>
                                    <th>Download</th>
                                    <th>#</th>
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
                                            <td>{{$data->closing_date}}</td>
                                            <td>{{$data->bid_opening_date}}</td>
                                            <td>
                                                @if($data->advertLot  && $data->advertLot->tender_document)
                                                    <a href="{{ Storage::disk('s3')->url($data->advertLot->tender_document ) }}" class="btn btn-sm btn-success" >Download Tender Document</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if(\Carbon\Carbon::parse($data->closing_date)->gt(\Carbon\Carbon::now()))
                                                <a href="#" data-id="{{ $data->advertLot->id }}" data-name="{{ $data->advertLot->description}}" class="btn btn-sm btn-primary addNewLot">
                                                    <i class="fa fa-file"></i> Upload Tender Document
                                                </a>
                                                @endif
                                                @if($data->contractor_tender_document)
                                                    <a href="{{ Storage::disk('s3')->url($data->contractor_tender_document ) }}" class="btn btn-sm btn-default" >Preview</a>
                                                @endif
                                            </td>
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


            <div class="modal fade newLotModal" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">
                                Upload <small id="headerTitle"> </small>
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-success d-none" id="mdas_div">
                                <span id="mdas_message"></span>
                            </div>

                            <form class="bs-example form-horizontal" action="{{ route('contractor_tender_document') }}"  method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-lg-12">Upload a file</label>
                                    <div class="col-lg-12">
                                        <input type="file" name="contractor_tender_document" class="form-control">
                                    </div>
                                </div>
                                <input type="hidden" name="advert_lot_id" id="advert_lot_id">
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Save Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </section>
</section>


<script>
    window.addEventListener('load', function () {
        $(".addNewLot").on('click', function(evt){
            evt.preventDefault();
            var currentId = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            $('#headerTitle').html(' '+name);
            $('#advert_lot_id').val(currentId);
            if(!currentId){
                console.log("Bug");
                return;
            }
            $(".newLotModal").modal('show');
        });
    });
</script>
@endsection

