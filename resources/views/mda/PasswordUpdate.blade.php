@extends('layouts.mda')
@section('changepassword')
active
@endsection

@section('content')
<br/>
    <div class="col-sm-8">
        <section class="panel panel-default">
        <header class="panel-heading font-bold">Password Update</header>
        <div class="panel-body">
            <form class="bs-example form-horizontal" action="{{action('ContractorController@updatePassword')}}" id="passwordForm" method="POST">


                <div class="form-group">
                    <label class="col-lg-2 control-label">Current Password</label>
                    <div class="col-lg-10">
                    <input type="password" id="password" name="password"  class="form-control">
                    <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
                    <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">New Password</label>
                    <div class="col-lg-10">
                    <input type="password" id="new_password" name="new_password"   required class="form-control">
                    <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Confirm Password</label>
                    <div class="col-lg-10">
                    <input type="password" id="confirm_password" name="confirm_password"  required class="form-control">
                    <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit"  id ="submitForm" name="submitForm" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save Data</button>
                    </div>
                </div>
            </form>
        </div>
        </section>
    </div>
    @endsection


