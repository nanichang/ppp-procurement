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
              Certificates
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
            <form class="bs-example form-horizontal" action="{{route('deleteName')}}" method="POST">


                {{csrf_field()}}
                <div class="row wrapper">
                    <div class="col-sm-5 m-b-xs">
                        <a href="#PDFRegistration" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Certificate Name</a>
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
                                <th data-toggle="class">Certificate Name</th>
                                <th>Date</th>


                            </tr>
                        </thead>
                        <tbody id="names">
                            @foreach($names as $name)
                                <tr>
                                     <td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="ids[]" value="{{$name->id}}"><i></i></label></td>

                                    <td>{{$name['certificate_name']}}</td>
                                    <td>{{$name['created_at']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </section>

        <div class="modal fade" id="PDFRegistration">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Requirement</h4>
            </div>
            <div class="modal-body">
            <form class="bs-example form-horizontal" action="{{ route('storeName') }}" method="POST">
            {{csrf_field()}}
                <div class="alert alert-success d-none" id="cat_div">
                    <span id="cat_message"></span>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Requirement Name</label>
                    <div class="col-lg-10">
                    <input type="text" required class="form-control" name="certificate_name" placeholder="Category Type" value="">
                    <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <button type="submit" name="categoryBtn" id="categoryBtn" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save Data</button>
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
