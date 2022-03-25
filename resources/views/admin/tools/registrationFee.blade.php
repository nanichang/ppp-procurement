
@extends('layouts.admin')
@section('tools')
active
@endsection
@section('content')

<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
          <br/>
        <section class="panel panel-info">
            <header class="panel-heading">
              Charges
            </header>
            <form class="bs-example form-horizontal" action="{{route('deleteFees')}}" method="POST">


                {{csrf_field()}}
                <div class="row wrapper">
                    <div class="col-sm-5 m-b-xs">
                        <a href="#RegistrationCategory" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Fee</a> 
                        <button id="btnDelete"  disabled class="delete-modal btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                        </button>
                    </div>
                </div>
   
                <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
                <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                        <th width="20"><label class="checkbox m-l m-t-none m-b-none i-checks"><input disabled type="checkbox"><i></i></label></th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Renewal</th>
                        </tr>
                    </thead>
                    <tbody id="names">
                    <?php  $i = 0; ?>
                    @if(sizeof($fees) > 0)
                        @foreach ( $fees as $data)
                        <tr>
                        <td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="ids[]" value="{{$data->id}}"><i></i></label></td>
                            <td>{{ $data['name'] }}</td>
                            <td>{{ $data['description'] }}</td>
                            <td>{{ number_format($data['amount']) }}</td>
                            <td>{{ number_format($data['renewal_fee']) }}</td>
                        </tr>
                        @endforeach
                    @else 
                        <tr>
                            <td colspan="5">No Record to Display</td>
                                
                        </tr>
                    @endif

                    </tbody>
                </table>
                </div>
            </form>
        </section>

    <div class="modal fade" id="RegistrationCategory">
         <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Category</h4>
            </div>
            <div class="modal-body">
                <form class="bs-example form-horizontal" action="{{ route('storeFee') }}" method="POST">
                    <div class="alert alert-success d-none" id="cat_div">
                        <span id="cat_message"></span>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Category Name</label>
                        <div class="col-lg-10">
                        <input type="text" required class="form-control" name="name" placeholder="Category Name" value="">
                        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Description</label>
                        <div class="col-lg-10">
                        <input type="text" required class="form-control" name="description" placeholder="Description" value="">
                        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Registration Fee</label>
                        <div class="col-lg-10">
                        <input type="number"  required class="form-control" name="amount" placeholder="Amount" value="">
                        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Renewal Fee</label>
                        <div class="col-lg-10">
                        <input type="number"  required class="form-control" name="renewal_fee" placeholder="Amount" value="">
                        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                        <button type="submit" name="categoryBtn" id="categoryBtn" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save Data</button>
                        <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />

                    </div>

                </form>
            </div>
        
    </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div>
</section>


<script>

    window.addEventListener('load', function () {
      $(document).ready(function() {
        var sumchecked = 0;
        $('#names').on('change', 'input[type="checkbox"]', function(){
          ($(this).is(':checked')) ? sumchecked++ : sumchecked--;
          (sumchecked > 0) ? $('#btnDelete').removeAttr('disabled') : $('#btnDelete').attr('disabled', 'disabled');
          
        });
      });
    });

</script>
@endsection
