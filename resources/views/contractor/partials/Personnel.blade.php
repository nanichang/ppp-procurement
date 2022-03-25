<section class="panel panel-default">
    <header class="panel-heading">
        Personnel
    </header>
    <form class="bs-example form-horizontal"  id="deletePersonnel" method="POST">

        @if(!$disableCrud)
            <div class="row wrapper">
                <div class="col-sm-5 m-b-xs">
                <a href="#addPersonnel" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Personnel</a> 
                <button type="submit" onclick="deletePersonnel()" class="btn btn-sm btn-danger">Delete</button>                
                </div>
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                <th width="20"><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox"><i></i></label></th>
                <th data-toggle="class">Full Name</th>
                <th>Gender</th>
                <th>Nationality</th>
                <th>Passport No.</th>
                <th>National ID</th>
                <th>Employee Type</th>
                <th>Joining Date</th>
                <th>Edit</th>
                </tr>
            </thead>
            <tbody id="personnels">
                @if(sizeof($personnels) > 0)
                @foreach ($personnels as $personnel)
                <tr>
                <td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="pids[]" value="{{$personnel->id}}"><i></i></label></td>
                <td>{{$personnel['first_name'].' '.$personnel['last_name']}}</td>
                <td>{{$personnel->gender}}</td>
                <td>{{$personnel->nationality}}</td>
                <td>{{$personnel->passport_no}}</td>
                <td>{{$personnel->national_id_no}}</td>
                <td>{{$personnel->employment_type}}</td>
                <td>{{$personnel->joining_date}}</td>
                <td>
                    <a href="#" class="active" data-toggle="class"><i class="fa fa-edit text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                </td>
                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="9"><label class="checkbox m-l m-t-none m-b-none i-checks">No Record Found</label></td>
                
                </tr>
            @endif
            </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">
            
            </div>
        </footer>
    </form>
</section>

<div class="modal fade" id="addPersonnel">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-primary">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Personnel Bio-Data</h4>
    </div>
    <div class="modal-body">
    <form class="bs-example form-horizontal" id="personnelForm" action="javascript:void(0)" method="POST">

         <div class="alert alert-success d-none" id="personnel_div">
              <span id="personnel_message"></span>
            </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">First Name</label>
            <div class="col-lg-10">
            <input name="first_name" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">Last Name</label>
            <div class="col-lg-10">
            <input name="last_name" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">Gender</label>
            <div class="col-sm-10">
            <label class="checkbox-inline">
                <input type="radio" required name="gender" value="male"> Male
            </label>
            <label class="checkbox-inline">
                <input type="radio" name="gender" value="female"> Female
            </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">Nationality</label>
            <div class="col-lg-10">
            <select name="nationality" required class="form-control">
                @foreach ($countries as $country)
                     <option value="{{$country->name}}">{{$country->name}}</option>
                @endforeach
            </select>
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">Passport No:</label>
            <div class="col-lg-10">
            <input name="passport_no" required class="form-control">
            <span class="help-block m-b-none">Enter N/A if not available</span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">National ID:</label>
            <div class="col-lg-10">
            <input name="national_id_no" required class="form-control">
            <span class="help-block m-b-none">Enter N/A if not available</span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">Employment Type</label>
            <div class="col-lg-10">
            <select name="employment_type" class="form-control">
                <option value="contract">Contract</option>
                <option value="contract">Part-Time</option>
                <option value="permanent">Permanent</option>
            </select>
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">Years of Experience:</label>
            <div class="col-lg-10">
            <input type="number" name="experience_years"  required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">joining Date:</label>
            <div class="col-lg-10">
            <input type="date" name="joining_date" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">Name of School:</label>
            <div class="col-lg-10">
            <input name="school_name"  required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">Qualification</label>
            <div class="col-lg-10">
            <select name="qualification" required class="form-control">
            @foreach ($qualifications as $qualification)
                <option value="{{$qualification->name}}">{{$qualification->name}}</option>
            @endforeach            </select>
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">Country</label>
            <div class="col-lg-10">
            <select name="country" required class="form-control">
            @foreach ($countries as $country)
                <option value="{{$country->name}}">{{$country->name}}</option>
            @endforeach
            </select>
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">Year of Graduation</label>
            <div class="col-lg-10">
            <input name="graduation_year" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">Regulatory Body</label>
            <div class="col-lg-10">
            <input name="regulatory_body" required class="form-control">
            <span class="help-block m-b-none">Enter N/A if not available</span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">Membership ID</label>
            <div class="col-lg-10">
            <input name="membership_id_no" required class="form-control">
            <span class="help-block m-b-none">Enter N/A if not available</span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">Project Involved</label>
            <div class="col-lg-10">
             <textarea name="project_involved" required class="form-control"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">Brief Description</label>
            <div class="col-lg-10">
                <textarea name="description" required class="form-control"></textarea>
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        </div>
            <div class="modal-footer">
            <button type="submit"  id ="submitPersonnel" name="submitPersonnel" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save Data</button>
        </div>

    </form>
    
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>

<script>
     window.addEventListener('load', function () {
        $("#personnelForm").submit(function(evt){
            evt.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var host = '{{URL::to('/')}}';
            var dataType =  'JSON';
            $.ajax({ 
                url : host + '/personnel/create',
                type : 'POST',
                data :$("#personnelForm").serialize(),
                dataType: dataType,
                success:function(response){
                    $('#submitPersonnel').html('Submitted');
                    $('#submitPersonnel').attr('disabled', 'disabled');
                    $('#personnel_message').show();
                    $('#personnel_message').html(response.success);
                    $('#personnel_div').show();
                    $('#personnel_div').removeClass('d-none');
                    
                    document.getElementById("personnelForm").reset(); 
                    setTimeout(function(){
                        $('#personnel_message').hide();
                        $('#personnel_div').hide();
                        $('#submitPersonnel').html('Save Data');
                        $('#submitPersonnel').removeAttr('disabled');
                        $('.close').trigger('click');
                    
                    },1000);

                    toastr.success(response.success, {timeOut: 1000});

                    
                    loadPersonnels('/personnel/personnels', function(data){
                    });
                },
                beforeSend: function(){
                    $('#submitPersonnel').html('Loading...');
                    $('#submitPersonnel').attr('disabled', 'disabled');
                },
                error: function(response) {
                    $('#submitPersonnel').html('Try Again');
                    $('#submitPersonnel').removeAttr('disabled');
                    toastr.error(response.responseJSON.error); //{timeOut: 5000}  

                
                }
            });
        })
     })


    function loadPersonnels(personnels, cb){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = '{{URL::to('/')}}';
        var dataType =  'JSON';
        $.ajax({
            type : 'GET',
            url : url + personnels,
            success:function(data){  
                //data = data.personnels; 
                $('#personnels').empty();
                if(data.length > 0){
                    $.each(data, function (i) {
                        $('#personnels').append(
                            '<tr>'+
                            '<td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="pids[]" value="'+data[i].id+'"><i></i></label></td>' +
                            '<td>'+data[i].first_name+' '+data[i].last_name+'</td>' +
                            '<td>'+data[i].gender+'</td>' +
                            '<td>'+data[i].nationality+'</td>'+
                            '<td>'+data[i].passport_no+'</td>'+
                            '<td>'+data[i].national_id_no+'</td>'+
                            '<td>'+data[i].employment_type+'</td>'+
                            '<td>'+data[i].joining_date+'</td>'+
                            '<td><a href="#" class="active" data-toggle="class"><i class="fa fa-edit text-success text-active"></i><i class="fa fa-times text-danger text"></i></a></td>'+
                            '</tr>'
                        );
                    });
                }
                else {
                    $('#personnels').append(
                        '<tr>'+
                        '<td colspan="9"><label class="checkbox m-l m-t-none m-b-none i-checks">No Record found</label></td>' +
                        '</tr>'
                    );
                }
            }
                      
        });   
    }


    function deletePersonnel(){
        $("#deletePersonnel").submit(function(evt){
            evt.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = '{{URL::to('/')}}';
            var dataType =  'JSON';
        
            $.ajax({
                type : 'POST',
                url : url + '/personnel/delete',
                data :$('#deletePersonnel').serialize(),
                dataType: dataType,
                success:function(data){    
                    $('#deleteBtn').html('Delete');
                    $('#deleteBtn').removeAttr('disabled');
                    document.getElementById("deletePersonnel").reset(); 
                
                    loadPersonnels('/personnel/personnels', function(data){
                    });

                },
                beforeSend: function(){
                    $('#deleteBtn').html('Sending..');
                    $('#deleteBtn').attr('disabled', 'disabled');
                },
                error: function(data) {
                    console.log('error', data)
                    $('#deleteBtn').html('Try Again');
                    $('#deleteBtn').removeAttr('disabled');
                    
                // show error to end user
                }
            });
        })

    }

    </script>