@extends('layouts.admin')
@section('reg-payment')
active
@endsection

@section('content')

<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
          <br/>
        <section class="panel panel-info">
            <header class="panel-heading">
              Registration Payment Lists
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
                                <th data-toggle="class">Payment Type</th>
                                <th>Payment Status</th>
                                <th>Amount Paid</th>
                                <th>Contractor</th>
                                <!-- <th>Amount</th> -->
                                <th>Status</th>
                                <th>Preview</th>
                            
                            </tr>
                        </thead>
                        <tbody> 
                            <?php $i = 1; ?>
                            @if(sizeof($payments) > 0)
                                @foreach($payments as $payment) 
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ucfirst($payment->payment_type)}}</td>
                                        <td>{{ucfirst($payment->status)}}</td>
                                        <td>{{number_format($payment->amount, 2)}}</td>   
                                        <td>{{$payment->contractor->company_name}}</td>
                                        <!-- <td>{{$payment->amount}}</td> -->
                                        <?php $status;
                                        if($payment->status=='verified'){ $status = 'text-success-dk'; } elseif($payment->status == 'pending'){$status = 'text-danger-dk' ;} else { $status = 'text-warning-dk';} ?>
                                        <td><i class="i i-circle-sm {{$status}}"></i></td> 
                                        <td>
                                            @if(sizeof($payment->documents))
                                              <a href="{{ Storage::disk('s3')->url($payment->documents[0]->document) }}" download class="active" >
                                                <span class="fa-stack fa-sm"> 
                                                  <i class="fa fa-circle fa-stack-2x text-info"></i>
                                                  <i class="fa fa-search fa-stack-1x text-white"></i>
                                                </span>
                                              </a>                          
                                            @endif
                                            @if($payment->status == 'pending') 
                                              <a href="#approvePayment{{ $payment->id }}" data-toggle="modal" class="btn btn-sm btn-success">Approve</a>
                                            @endif
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
         @foreach($payments as $payment) 
          <div class="modal fade" id="approvePayment{{ $payment->id }}">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header bg-warning">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Warning</h4>
                      </div>
                      <div class="modal-body">
                          <form class="bs-example form-horizontal" action="{{ route('registration.payment.approve') }}" method="POST">
                              {{ csrf_field() }}
                              <div class="alert alert-success d-none" id="mdas_div">
                                  <span id="mdas_message"></span>
                              </div>
                              <input type="hidden" name="payment_id" value="{{ $payment->id }}">
                              <input type="hidden" name="contractor_id" value="{{ $payment->contractor_id }}">
                              <input type="hidden" name="payment_type" value="{{$payment->payment_type }}">
                              <input type="hidden" name="amount" value="{{$payment->amount }}">
                              <input type="hidden" name="id" value="{{$payment->id }}">
                              <h4>
                                Are you sure you want to approve 
                                <strong>{{ucfirst($payment->payment_type)}}</strong> 
                                payment of 
                                <strong>{{number_format($payment->amount, 2)}}</strong> 
                                for 
                                <strong>{{$payment->contractor->company_name}}</strong>
                               </h4>
                              <div class="modal-footer">
                                  <!-- <a href="#" id="mdasBtn" class="btn btn-sm btn-primary">Save Data</a> -->
                                  <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Approve Payment</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
        @endforeach

@endsection
