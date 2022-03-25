<section class="panel panel-default">
    <header class="panel-heading">
        Jobs Carried Out
    </header>
    <form class="bs-example form-horizontal"  id="deleteJob" method="POST">
    @if(!$disableCrud)
        <div class="row wrapper">
            <div class="col-sm-5 m-b-xs">
            <a href="#addJob" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Job</a> 
            <button type="submit" name="jobDelete" onclick="deleteJob()" class="btn btn-sm btn-danger">Delete</button>                
            </div>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
        <thead>
            <tr>
            <th width="20"><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox"><i></i></label></th>
            <th data-toggle="class">Job Category</th>
            <th>Organization</th>
            <th>Job Title</th>
            <th>Job Description</th>
            <th>Contact Person</th>
            <th>Award Date</th>
            <th>Amount</th>
            </tr>
        </thead>
        <tbody id="jobs">
         @if(sizeof($jobs) > 0) 
            @foreach ($jobs as $job)
                <tr>
                <td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="jids[]" value="{{$job->id}}"><i></i></label></td>
                <td>{{$job->job_category}}</td>
                <td>{{$job->client}}</td>
                <td>{{$job->job_title}}</td>
                <td>{{$job->job_description}}</td>
                <td>{{$job->contact_phone}}</td>
                <td>{{$job->award_date}}</td>
                <td>{{number_format($job->amount)}} NGN</td>
               
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8"><label class="checkbox m-l m-t-none m-b-none i-checks">No Record Found</label></td>
            
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

<div class="modal fade" id="addJob">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-primary">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Company's Work Experience</h4>
    </div>
    <div class="modal-body">
    <form class="bs-example form-horizontal" id="jobForm" action="javascript:void(0)" method="POST">

         <div class="alert alert-success d-none" id="job_div">
              <span id="job_message"></span>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Select Job Category</label>
            <div class="col-lg-9">
            
             {!! Form::select('business_category_id', $vehicleMakes, 'default', array('id' => 'category_id', 'required' => true, 'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Sub-Category</label>
            <div class="col-lg-9">
                {!! Form::select('sub_category', $vehicleModels, 'default', array('id' => 'category', 'required' => true, 'class' => 'form-control')) !!}
            </div>
        </div>

       

        <div class="form-group">
            <label class="col-lg-3 control-label">Job Title</label>
            <div class="col-lg-9">
            <input name="job_title"  required class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Job Description</label>
            <div class="col-lg-9">
            <textarea name="job_description" required class="form-control"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Client</label>
            <div class="col-lg-9">
             <input type="text" name="client" required class="form-control">

           
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Contact Phone:</label>
            <div class="col-lg-9">
             <input type="number" name="contact_phone" required class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Award Date:</label>
            <div class="col-lg-9">
            <input type="date" name="award_date" required class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Amount N:</label>
            <div class="col-lg-9">
            <input type="number" name="amount" required class="form-control">
            </div>
        </div>
        <div class="modal-footer">
        <button type="submit"  id ="submitJob" name="submitJob" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save Data</button>
        </div>

    </form>
    </div>
    
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>


<script>

    var make_model_mapping = {!! $jsArray !!};

    window.addEventListener('load', function () {

        $('#category_id').on('change', function (e) {
                var options = $("#category").empty().html(' ');
                $.each(make_model_mapping[this.value], function() {
                    options.append($("<option />").val(this.id).text(this.name));
                });
            });


    $("#jobForm").submit(function(evt){
            evt.preventDefault();
            $cat = $('#category_id').val();
            if($cat == 'default'){
                alert('Category is compulsory');
                return;
            }
            $subcat = $('#category').val();
            if($subcat == 'default'){
                alert('Sub Category is compulsory');
                return;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var host = '{{URL::to('/')}}';
            var dataType =  'JSON';
            $('#submitJob').html('Sending..');
            $.ajax({ 
                url : host + '/job/create',
                type : 'POST',
                data :$("#jobForm").serialize(),
                dataType: dataType,
                success:function(response){
                    $('#submitJob').html('Save Data');
                    $('#job_message').show();
                    $('#job_message').html(response.success);
                    $('#job_div').removeClass('d-none');
                    $('#submitJob').attr('disabled', 'disabled');


                    $('#job_div').show();
                    document.getElementById("jobForm").reset(); 
                    setTimeout(function(){
                        $('#job_message').hide();
                        $('#job_div').hide();
                        $('.close').trigger('click');
                        $('#submitJob').removeAttr('disabled');

                    },1000);
                    toastr.success(response.success, {timeOut: 1000});


                    loadJobs('/job/jobs', function(response){
                        });

                    
                },
                beforeSend: function(){
                    $('#submitJob').html('Loading...');
                    $('#submitJob').attr('disabled', 'disabled');
                },
                error: function(response) {
                    $('#submitJob').html('Try Again');
                    $('#submitJob').removeAttr('disabled');
                    toastr.error(response.responseJSON.error); //{timeOut: 5000}  

                    console.log(data)
                
                }
            });
        })
    })

    function loadJobs(jobs, cb){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = '{{URL::to('/')}}';
        var dataType =  'JSON';
        $.ajax({
            type : 'GET',
            url : url + jobs,
             success:function(data){  
                data = data.jobs; 
                $('#jobs').empty();
                if(data.length > 0){
                    $.each(data, function (i) {
                        $('#jobs').append(
                            '<tr>'+
                            '<td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="jids[]" value="'+data[i].id+'"><i></i></label></td>' +
                            '<td>'+data[i].job_category +'</td>' +
                            '<td>'+data[i].client+ '</td>' +
                            '<td>'+data[i].job_title+'</td>'+
                            '<td>'+data[i].job_description+'</td>'+
                            '<td>'+data[i].contact_phone+'</td>'+
                            '<td>'+data[i].award_date +'</td>'+
                            '<td>'+data[i].amount+'</td>'+
                            '</tr>'
                        );
                    });

                }else {
                    $('#jobs').append(
                        '<tr>'+
                        '<td colspan="8"><label class="checkbox m-l m-t-none m-b-none i-checks">No Record found</label></td>' +
                        '</tr>'
                    );
                }
                  
            },
        });   
    }

    function deleteJob(){
    $("#deleteJob").submit(function(evt){
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
            url : url + '/job/delete',
            data :$('#deleteJob').serialize(),
            dataType: dataType,
            success:function(data){    
                document.getElementById("deleteJob").reset(); 
                $('#jobBtn').html('Delete');
                $('#jobBtn').removeAttr('disabled'); 
                  
                loadJobs('/job/jobs', function(data){
                });

            },
            beforeSend: function(){
                $('#jobBtn').html('Sending..');
                $('#jobBtn').attr('disabled', 'disabled');
            },
            error: function(data) {
                console.log('error', data)  
                $('#jobBtn').html('Try Again');
                $('#jobBtn').removeAttr('disabled');        
            // show error to end user
            }
        });
    })

}



</script>