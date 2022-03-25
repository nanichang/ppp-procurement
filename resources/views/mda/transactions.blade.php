@extends('layouts.mda')

@section('transactions')
active
@endsection
@section('content')
<script
  src="https://code.jquery.com/jquery-3.4.0.min.js"
  integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
  crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Bidding process transactions</h4>
                            </div>
                            <!--tables-->
                            <div class="row">
                                <div class="col-md-12">
                                   <table class="table table-bordered table-striped table-condensed" id="table" >
                                        <thead>
                                            <tr>
                                                <th class="text-center">Transaction ID</th>
                                                <th class="text-center">Advert Name</th>
                                                <th class="text-center">Lot Description</th>
                                                <th class="text-center">Contractor</th>
                                                <th class="text-center">Amount</th>
                                                <th class="text-center">Payment Evidence</th>
                                                <th class="text-center">Payment Status</th>
                                                <th class="text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if (empty($transactions))
                                            <tr>
                                            <td>No Records found</td>
                                            </tr>
                                        @else
                                        <?php  $i = 0; ?>
                                            @foreach ($transactions as $transaction)
                                            <tr class="">
                                                <td>{{ $transaction['transaction_id'] }}</td>
                                                <td>{{ $transaction['advert_name'] }}</td>
                                                <td>{{ $transaction['lot_description'] }}</td>
                                                <td>{{ $transaction['user_name'] }}</td>
                                                <td>{{ number_format($transaction['amount']) }}</td>
                                                <td>                                                    
                                                    @if($transaction->payment_document)
                                                        <a href="{{ Storage::disk('s3')->url($transaction['payment_document']) }}" class="btn btn-s-md btn-primary btn-rounded">
                                                            <i class="fa fa-file"></i> Payment Evidence
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                @if ($transaction->payment_status === 'Paid')
                                                    <span class="label label-success">{{ $transaction->payment_status }}</span>
                                                @else
                                                    <span class="label label-danger">{{ $transaction->payment_status }}</span>
                                                @endif
                                                </td>
                                                <td>
                                                <form action="{{ url('mda/close_payment/' .$transaction['id'] ) }}" method="POST">
                                                    {!! csrf_field() !!}
                                                    <button type="submit" class="btn btn-success btn-sm">Update payment</button>
                                                </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--end table-->
                        </div>
                    </div>

                </div>
            </div>

<script>
window.addEventListener('load', function () {
    $(document).ready(function() {
    $.noConflict(true);
    $('.table').DataTable();
    } );
});
 </script>
@endsection

