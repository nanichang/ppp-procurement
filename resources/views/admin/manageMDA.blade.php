@extends('layouts.admin')
@section('getmdas')
active
@endsection

@section('content')
<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
            <br/>
            <section class="panel panel-info">
                <header class="panel-heading">
                    Ministries Department and Agencies (MDA)
                </header>

                <form class="bs-example form-horizontal" id="deleteMdas" action="javascript:void(0)" Method="POST">
                <div class="row wrapper">
                    <div class="col-sm-9 m-b-xs">
                        <a href="#addNewMDA" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New</a>
                        <button id="mdaBtn" class="btn btn-sm btn-danger">Delete</button>
                    </div>
                    <!-- <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" class="input-sm form-control" placeholder="Search">
                            <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                      </span>
                        </div>
                    </div> -->
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th width="20">
                                    <label class="checkbox m-l m-t-none m-b-none i-checks">
                                        <input type="checkbox"><i></i></label>
                                </th>
                                <th data-toggle="class">MDA</th>
                                <th>MDA Code</th>
                                <th>Category</th>
                                <th>Email</th>
                                <!-- <th>Edit</th> -->
                                <th>Preview</th>
                            </tr>
                        </thead>
                        <tbody id="mdas">
                        <?php  $i = 0; ?>
                        @if(sizeof($mdas) > 0)
                            @foreach ($mdas as $data)
                                <tr>
                                    <td>
                                        <label class="checkbox m-l m-t-none m-b-none i-checks">
                                            <input type="checkbox" name="mda[]" value="{{ $data['id']}}"><i></i></label>
                                    </td>
                                    <td>{{ $data['name'] }}</td>
                                    <td>{{ $data['mda_code'] }}</td>
                                    <td>{{ $data['subsector'] }}</td>
                                    <td>{{ $data['email'] }}</td>
                                    <!-- <td>
                                        <a href="#" class="active" data-toggle="class"><i class="fa fa-edit text-success text-active"></i><i class="fa fa-edit text-success text"></i></a>
                                    </td> -->
                                    <td>
                                        <a href="{{ route('mdasPreview',$data['id']) }}" class="active"><i class="fa fa-search text-success text-active"></i><i class="fa fa-search text-success text"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        <td colspan="6">{{' No Record Found '}}</td>
                        @endif
                        </tbody>
                    </table>
                    {{ $mdas->links() }}
                </div>
            </form>
            </section>

            <div class="modal fade" id="addNewMDA">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add New MDA</h4>
                        </div>
                        <div class="modal-body">
                            <form class="bs-example form-horizontal"  id="mdasform" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="alert alert-success d-none" id="mdas_div">
                                <span id="mdas_message"></span>
                            </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Name of MDA</label>
                                    <div class="col-lg-9">
                                        <input name="name" required class="form-control">
                                        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">MDA Logo</label>
                                    <div class="col-lg-9">
                                        <input type="file"  name="profile_pic" class="form-control">
                                        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">MDA Code</label>
                                    <div class="col-lg-9">
                                        <input name="mda_code" required class="form-control">
                                        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">MDA Short Code</label>
                                    <div class="col-lg-9">
                                        <input name="mda_shortcode" required class="form-control">
                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Select Sector</label>
                                    <div class="col-lg-9">
                                    <select name="subsector" class="form-control">
                                    @foreach ($categories as $category)

                                        <option value="{{$category->name}}">{{$category->name}}</option>
                                    @endforeach
                                    </select>
                                        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Address</label>
                                    <div class="col-lg-9">
                                        <textarea required name="address" class="form-control"></textarea>
                                        <!-- <span class="help-block m-b-none">URL</span> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Email</label>
                                    <div class="col-lg-9">
                                        <input name="email" required class="form-control">
                                        <!-- <span class="help-block m-b-none">URL</span> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Password</label>
                                    <div class="col-lg-9">
                                        <input type="password" required name="password" class="form-control">
                                        <!-- <span class="help-block m-b-none">URL</span> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Website</label>
                                    <div class="col-lg-9">
                                        <input type="website"  name="website" class="form-control">
                                        <!-- <span class="help-block m-b-none">URL</span> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Telephone</label>
                                    <div class="col-lg-9">
                                        <input type="number" required name="phone" class="form-control">
                                        <!-- <span class="help-block m-b-none">URL</span> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Mandate</label>
                                    <div class="col-lg-9">
                                        <textarea name="mandate" required class="form-control"></textarea>
                                        <!-- <span class="help-block m-b-none">URL</span> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Bank Name</label>
                                    <div class="col-lg-9">
                                    
                                        <select required name="bank_name" class="form-control">
                                            @foreach ($banks as $bank)
                                            <option value="{{ $bank }}">{{ $bank }}</option>
                                            @endforeach
                                        </select>
                                        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Bank Account</label>
                                    <div class="col-lg-9">
                                        <input type="number" required name="bank_account" class="form-control">
                                        <!-- <span class="help-block m-b-none">URL</span> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Split Percentage</label>
                                    <div class="col-lg-9">
                                        <input type="text" required name="split_percentage" class="form-control">
                                        <!-- <span class="help-block m-b-none">URL</span> -->
                                    </div>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <!-- <a href="#" id="mdasBtn" class="btn btn-sm btn-primary">Save Data</a> -->
                            <button type="submit" name="mdasBtn" id="mdasBtn" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Save Data</button>
                        </div>
                    </div>
                    </form>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
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
          var url = '{{URL::to('/')}}';
          var dataType =  'JSON';
      
          $.ajax({
              method : 'POST',
              url : url + '/mda/delete',
              data :$('#deleteMdas').serialize(),
              dataType: dataType,
              success:function(response){    
                  $('#mdaBtn').html('Delete');
                  $('#mdaBtn').removeAttr('disabled');     
                  loadMdas('/mda/list', function(response){
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
            $.ajax({
                type : "POST",
                url : "{{url('/mda/create')}}",
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

                    loadMdas('/mda/list', function(data){
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


    function loadMdas(mdas, cb) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    var url = '{{URL::to('/')}}';
     
    var dataType =  'JSON';
    $.ajax({
      type : 'GET',
      url : url + mdas,
      success:function(data){  
        $('#mdas').empty();
            location.reload();   
        },
      });   
    }

</script>
@endsection





