@extends('layouts.app')
@section('changepassword')
  active
@endsection

@section('content')
<br/>
    <div class="col-sm-8">
        <section class="panel panel-default">
        <header class="panel-heading font-bold">Verify Payment</header>
        <div class="panel-body">
            <form class="bs-example form-horizontal" action="{{ route('contractor.registration.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="contractor_id" value="{{ $contractor->id }}">

                <div class="form-group">
                    <label class="col-lg-2 control-label" for="amount">Amount Paid</label>
                    <div class="col-lg-10">
                      <input type="text" disabled  value="{{ $cr->amount }}" class="form-control">
                      <input type="hidden" id="amount" name="amount" value="{{ $cr->amount }}">
                      <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
                    <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label" for="payment_type">Payment Type</label>
                    <div class="col-lg-10">
                      <select name="payment_type" id="payment_type" class="form-control">
                          <option value="cash">Cash</option>
                          <option value="online">Online</option>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Upload Payment evidence</label>
                    <div class="col-lg-10">
                      <input type="file" id="document" name="document" required class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Upload Document</button>
                    </div>
                </div>
            </form>
        </div>
        </section>
    </div>
    @endsection

