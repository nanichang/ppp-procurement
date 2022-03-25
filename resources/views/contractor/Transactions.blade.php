@extends('layouts.app')
@section('transactions')
active
@endsection
@section('content')

<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
          <br/>
        <section class="panel panel-info">
            <header class="panel-heading">
              {{'List of  Transactions'}}
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

                                <th width="20">S/NO</th>
                                <th>Transaction ID</th>
                                <th>MDA</th>
                                <th>Advert Name</th>
                                <th>Lot Description</th>
                                <th>Amount</th>
                                <th>Payment Status</th>
                                <th>Payment Date</th>
                                <th>Upload</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @if(sizeof($transactions) > 0)
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$transaction->transaction_id}}</td>
                                        <td>{{$transaction->mda_name}}</td>
                                        <td>{{$transaction->advert_name}}</td>
                                        <td>{{$transaction->lot_description}}</td>
                                        <td>{{number_format($transaction->amount)}}</td>
                                        <td>
                                            @if ($transaction->payment_status === 'Paid')
                                                <span class="label label-success">{{ $transaction->payment_status }}</span>
                                            @else
                                                <span class="label label-danger">{{ $transaction->payment_status }}</span>
                                            @endif
                                            <?php $payment_date = $transaction->payment_date ? $transaction->payment_date : 'Not Available' ;?>
                                        <td>{{$payment_date}}</td>
                                        <td>
                                                @if($transaction->payment_status != 'Paid')
                                                <a href="#" data-id="{{ $transaction->id }}" data-name="{{ $transaction->transaction_id}}" class="btn btn-sm btn-primary addPaymentDoc">
                                                    <i class="fa fa-file"></i> Upload Payment Document
                                                </a> 
                                                @endif
                                                @if($transaction->payment_document) 
                                                    <a href="{{ Storage::disk('s3')->url($transaction->payment_document ) }}" class="btn btn-sm btn-default" >Preview</a>
                                                @endif
                                        </td>
                                        <td>
                                            @foreach($transaction->awards as $award)
                                                @if($award->status == "awarded" || $award->status == "accepted")
                                                <a href="/contractor/awards/{{$award->id}}" class="btn btn-sm btn-success" > <i class="fa fa-trophy"></i> Award</a>
                                                @endif
                                            @endforeach
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

         <div class="modal fade paymentDocModal" >
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

                            <form class="bs-example form-horizontal" action="{{ route('payment_document') }}"  method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-lg-12">Payment proof</label>
                                    <div class="col-lg-12">
                                        <input type="file" name="payment_document" class="form-control">
                                    </div>
                                </div>
                                <input type="hidden" name="sale_id" id="sale_id">
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Save Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                window.addEventListener('load', function () {
                    $(".addPaymentDoc").on('click', function(evt){
                        evt.preventDefault();
                        var currentId = $(this).attr('data-id');
                        var name = $(this).attr('data-name');
                        $('#headerTitle').html(' '+name);
                        $('#sale_id').val(currentId);
                        if(!currentId){
                            console.log("Bug");
                            return;
                        }
                        $(".paymentDocModal").modal('show');
                    });
                });
            </script>

@endsection
