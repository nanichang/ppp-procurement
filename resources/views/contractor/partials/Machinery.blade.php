<section class="panel panel-default">
    <header class="panel-heading">
        Machineries
    </header>
    <form class="bs-example form-horizontal"  id="deleteMachinery" method="POST">
    @if(!$disableCrud)
        <div class="row wrapper">
            <div class="col-sm-5 m-b-xs">
            <a href="#addEquipment" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Equipment</a> 
            <button type="submit" id="deleteMachine" onclick="deleteMachinery()" class="btn btn-sm btn-danger">Delete</button>                
            </div>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
        <thead>
            <tr>
            <th width="20"><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox"><i></i></label></th>
            <th data-toggle="class">Equipment type</th>
            <th>Acquisition Date</th>
            <th>Cost (N)</th>
            <th>Location</th>
            <th>Serial No.</th>
            <th>Reg. No.</th>
            <th>Status</th>
            <th>Edit</th>
            </tr>
        </thead>
        <tbody id="machineries">
            @if(sizeof($machineries)> 0)
                @foreach($machineries as $machinery)
                <tr>
                <td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="mids[]" value="{{$machinery->id}}"><i></i></label></td>
                <td>{{$machinery->equipment_type}}</td>
                <td>{{$machinery->acquisition_date}}</td>
                <td>{{number_format($machinery->cost)}}</td>
                <td>{{$machinery->location}}</td>
                <td>{{$machinery->serial_no}}</td>
                <td>{{$machinery->specifics}}</td>
                <td>{{$machinery->equipment_status}}</td>
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

<div class="modal fade" id="addEquipment">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-primary">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Machineries/Equipment</h4>
    </div>
    <div class="modal-body">
    <form class="bs-example form-horizontal"  id="machineryForm" action="javascript:void(0)" method="POST">
        <div class="alert alert-success d-none" id="machinery_div">
              <span id="machinery_message"></span>
            </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Equipment Type</label>
            <div class="col-lg-9">
            <select name="equipment_type" class="form-control">
                @foreach ($equipments as $equipment)
                     <option value="{{$equipment->equipment_type}}">{{$equipment->equipment_type}}</option>
                @endforeach
            </select>
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Specify</label>
            <div class="col-lg-9">
            <input name="specifics" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Acquisition Date:</label>
            <div class="col-lg-9">
            <input  type="date" name="acquisition_date" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Cost</label>
            <div class="col-lg-9">
            <input type="number" name="cost"  required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Location</label>
            <div class="col-lg-9">
            <input name="location" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Serial No:</label>
            <div class="col-lg-9">
            <input name="serial_no" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Equipment Status</label>
            <div class="col-lg-9">
            <select name="equipment_status" required class="form-control">
                <option value="functional">functional</option>
                <option value="not-functional">not-functional</option>
            </select>
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit"  id ="submitMachinery" name="submitMachinery" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save Data</button>
        </div>
    </form>
    </div>
    
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>


<script>
    window.addEventListener('load', function () {

        $("#machineryForm").submit(function(evt){
            evt.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var host = '{{URL::to('/')}}';
            var dataType =  'JSON';
            $.ajax({ 
                url : host + '/machinery/create',
                type : 'POST',
                data :$("#machineryForm").serialize(),
                dataType: dataType,
                success:function(response){
                    $('#submitMachinery').html('Submitted');
                    $('#submitMachinery').attr('disabled', 'disabled');
                    $('#machinery_message').show();
                    $('#machinery_message').html(response.success);
                    $('#machinery_div').show();
                    $('#machinery_div').removeClass('d-none');
                    document.getElementById("machineryForm").reset(); 
                    setTimeout(function(){
                        $('#machinery_message').hide();
                        $('#machinery_div').hide();
                        $('.close').trigger('click');
                        $('#submitMachinery').html('Save Data');
                        $('#submitMachinery').removeAttr('disabled');
                    },1000);   
                    toastr.success(response.success, {timeOut: 1000});


                    loadMachineries('/machinery/machineries', function(data){
                });
                },
                beforeSend: function(){
                    $('#submitMachinery').html('Loading...');
                    $('#submitMachinery').attr('disabled', 'disabled');
                },
                error: function(response) {
                    $('#submitMachinery').html('Try Again');
                    $('#submitMachinery').removeAttr('disabled');
                    toastr.error(response.responseJSON.error); //{timeOut: 5000}  

                    console.log(response)
                
                }
            });

        })
    })

    function loadMachineries(machineries, cb){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = '{{URL::to('/')}}';
        var dataType =  'JSON';
        $.ajax({
            type : 'GET',
            url : url + machineries,
            success:function(data){  
                $('#machineries').empty();
                if(data.length > 0) {
                    $.each(data, function (i) {
                        $('#machineries').append(
                            '<tr>'+
                            '<td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="ids[]" value="'+data[i].id+'"><i></i></label></td>' +
                            '<td>'+data[i].equipment_type+'</td>' +
                            '<td>'+data[i].acquisition_date+'</td>' +
                            '<td>'+data[i].cost+'</td>'+
                            '<td>'+data[i].location+'</td>'+
                            '<td>'+data[i].serial_no+'</td>'+
                            '<td>'+data[i].specifics+'</td>'+
                            '<td>'+data[i].equipment_status+'</td>'+
                            '<td><a href="#" class="active" data-toggle="class"><i class="fa fa-edit text-success text-active"></i><i class="fa fa-times text-danger text"></i></a></td>'+
                            '</tr>'
                        );
                    });
                }else {
                    $('#machineries').append(
                        '<tr>'+
                        '<td colspan="9"><label class="checkbox m-l m-t-none m-b-none i-checks">No Record found</label></td>' +
                        '</tr>'
                    );
                }
                  
            },
        });   
    }
    
    function deleteMachinery(){
        $("#deleteMachinery").submit(function(evt){
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
                url : url + '/machinery/delete',
                data :$('#deleteMachinery').serialize(),
                dataType: dataType,
                success:function(data){    
                    document.getElementById("deleteMachinery").reset(); 
                    $('#deleteMachine').html('Delete');
                    $('#deleteMachine').removeAttr('disabled');
                    loadMachineries('/machinery/machineries', function(data){
                    });

                },
                beforeSend: function(){
                    $('#deleteMachine').html('Sending..');
                    $('#deleteMachine').attr('disabled', 'disabled');
                },
                error: function(data) {
                    console.log('error', data)
                    $('#deleteMachine').html('Try Again');
                    $('#deleteMachine').removeAttr('disabled');
                    
                // show error to end user
                }
            });
        })

    }
 </script>