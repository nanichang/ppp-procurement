@extends('layouts.admin')
@section('procurement-plan')
    active
@endsection

@section('content')
    <section class="hbox stretch">
        <section class="vbox">
            <section class="scrollable padder">
                <br/>
                <section class="panel panel-info">
                    <header class="panel-heading">
                        Procurement Year
                    </header>

                    <form class="bs-example form-horizontal" id="deleteMdas" action="javascript:void(0)" Method="POST">
                        <div class="row wrapper">
                            <div class="col-sm-9 m-b-xs">
                                <a href="#addNewMDA" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New</a>
                                <button id="mdaBtn" class="btn btn-sm btn-danger">Delete</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped b-t b-light">
                                <thead>
                                <tr>
                                    <th width="20">
                                        <label class="checkbox m-l m-t-none m-b-none i-checks">
                                        <input type="checkbox"><i></i></label>
                                    </th>
                                    <th data-toggle="class">Year</th>
                                    <th>Action</th>
                                    <th>Active Status</th>
                                    <th>Preview</th>
                                </tr>
                                </thead>
                                <tbody id="mdas">
                                <?php  $i = 0; ?>
                                @if(sizeof($allYears) > 0)
                                    @foreach ($allYears as $data)
                                        <tr>
                                            <td>
                                                <label class="checkbox m-l m-t-none m-b-none i-checks">
                                                    <input type="checkbox" name="mda[]" value="{{ $data['id']}}"><i></i></label>
                                            </td>
                                            <td>{{ $data['year'] }}</td>
                                            <td>{{ ($data['active'] == 1) ? 'Is Active' : 'Not active' }}</td>
                                            <!-- <td>
                                                <a href="#" class="active" data-toggle="class"><i class="fa fa-edit text-success text-active"></i><i class="fa fa-edit text-success text"></i></a>
                                            </td> -->
                                            <td>
                                            @if(getUserRole() == 'admin')
                                                @if($data['active'] == 1)
                                                    <a href="{{ route('procurementYear.disable',$data['id']) }}" class="btn btn-danger btn-sm active">Disable year</a>
                                                @else
                                                    <a href="{{ route('procurementYear.enable',$data['id']) }}" class="btn btn-success btn-sm active">Enable year</a>
                                                @endif
                                            @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td colspan="6">{{' No Record Found '}}</td>
                                @endif
                                </tbody>
                            </table>
                            {{ $allYears->links() }}
                        </div>
                    </form>
                </section>

                <div class="modal fade" id="addNewMDA">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add New Procurement Year</h4>
                            </div>
                            <div class="modal-body">
                                <form class="bs-example form-horizontal"  id="mdasform" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="alert alert-success d-none" id="mdas_div">
                                        <span id="mdas_message"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Enter Procurement Year</label>
                                        <div class="col-lg-9">
                                            <input name="year" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <!-- <a href="#" id="mdasBtn" class="btn btn-sm btn-primary">Save Data</a> -->
                                        <button type="submit" name="mdasBtn" id="mdasBtn" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Save Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>

    <script type="application/javascript">

        window.addEventListener('load', function () {
            $("#deleteMdas").submit(function(evt){
                evt.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let url = '{{ route('procurementYear.delete')}}';
                let dataType =  'JSON';
                let indexUrl = "{{ route('procurementYear.index')  }}";

                $.ajax({
                    method : 'POST',
                    url : url,
                    data :$('#deleteMdas').serialize(),
                    dataType: dataType,
                    success:function(response){
                        $('#mdaBtn').html('Delete');
                        $('#mdaBtn').removeAttr('disabled');
                        loadYears(indexUrl, function(response){
                        });
                        toastr.success(response.success, {timeOut: 1000});

                    },

                    beforeSend: function(){
                        $('#mdaBtn').html('Sending..');
                        $('#mdaBtn').attr('disabled', 'disabled');
                    },
                    error: function(response) {
                        $('#mdaBtn').html('Try Again');
                        $('#mdaBtn').removeAttr('disabled');
                        toastr.error(response.responseJSON.error); //{timeOut: 5000}

                        // show error to end user
                    }
                });
            })

        })

        window.addEventListener('load', function () {
            $("#mdasform").on( "submit",function(evt){
                evt.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = '{{URL::to('/')}}';

                var dataType =  'JSON';

                var indexUrl = "{{ route('procurementYear.index')  }}";

                $.ajax({
                    type : "POST",
                    url : "{{ route('procurementYear.store') }}",
                    data: new FormData( this ),
                    contentType: false,
                    processData: false,
                    dataType: dataType,

                    success:function(response){
                        $('#mdasBtn').html('Submitted');
                        $('#mdasBtn').removeAttr('disabled');
                        $('#mdas_message').show();
                        $('#mdas_div').show();
                        $('#mdas_message').html(response.success);
                        $('#mdas_div').removeClass('d-none');
                        document.getElementById("mdasform").reset();
                        setTimeout(function(){
                            $('#mdas_message').hide();
                            $('#mdas_div').hide();
                            $('#mdasBtn').html('Save Data');
                            $('.close').trigger('click');
                        },1000);

                        loadYears(indexUrl, function(data){
                        });
                        toastr.success(response.success, {timeOut: 1000});
                    },
                    beforeSend: function(){
                        $('#mdasBtn').html('Sending..');
                        $('#mdasBtn').attr('disabled', 'disabled');
                    },
                    error: function(response) {
                        console.log('error', response)
                        $('#mdasBtn').html('Try Again');
                        $('#mdasBtn').removeAttr('disabled');
                        toastr.error(response.responseJSON.error); //{timeOut: 5000}
                        // show error to end user
                    }
                });
            });
        });


        function loadYears(years, cb) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var dataType =  'JSON';
            $.ajax({
                type : 'GET',
                url : years,
                success:function(data){
                    $('#mdas').empty();
                    location.reload();
                },
            });
        }

    </script>
@endsection





