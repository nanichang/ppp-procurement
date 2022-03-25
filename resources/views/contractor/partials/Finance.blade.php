<section class="panel panel-default">
    <header class="panel-heading">
        Company Financial Report
    </header>
    <form class="bs-example form-horizontal"  id="deleteFinance" method="POST">
    @if(!$disableCrud)
        <div class="row wrapper">
            <div class="col-sm-5 m-b-xs">
            <a href="#addFinancialReport" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Financial Report</a> 
            <button type ="submit" id="financeBtn" onclick="deleteFinance()" class="btn btn-sm btn-danger">Delete</button>                
            </div>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
        <thead>
            <tr>
            <th width="20"><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox"><i></i></label></th>
            <th data-toggle="class">Year</th>
            <th>Turn Over (N)</th>
            <th>Total Assets (N)</th>
            <th>Total Liability (N)</th>
            <th>Witholding Tax (N)</th>
            <th>Tax Paid (N)</th>
            <th>TCC No.</th>
            <th>Audit Firm</th>
            <th>Date</th>
            <th>Edit</th>
            </tr>
        </thead>
        <tbody id="finances">
        @if(sizeof($finances) > 0)
         @foreach ($finances as $finance)

            <tr>
            <td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="fids[]" value="{{$finance->id}}"><i></i></label></td>
            <td>{{$finance->year}}</td>
            <td>{{number_format($finance->turn_over)}} NGN</td>
            <td>{{number_format($finance->total_asset)}} NGN</td>
            <td>{{number_format($finance->total_liability)}} NGN</td>
            <td>{{number_format($finance->witholding_tax)}} NGN</td>
            <td>{{number_format($finance->tax_paid)}} NGN</td>
            <td>{{number_format($finance->tcc_no)}} NGN</td>
            <td>{{$finance->audit_firm}}</td>
            <td>{{$finance->report_date}}</td>         
            <td>
                <a href="#" class="active" data-toggle="class"><i class="fa fa-edit text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
            </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10"><label class="checkbox m-l m-t-none m-b-none i-checks">No Record Found</label></td>
          
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

<div class="modal fade" id="addFinancialReport">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header bg-primary">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Company's Finance</h4>
    </div>
    <div class="modal-body">
    <form class="bs-example form-horizontal" id="financeForm" method="POST">

         <div class="alert alert-success d-none" id="finance_div">
              <span id="finance_message"></span>
        </div>
        
        <div class="form-group">
            <label class="col-lg-3 control-label">Enter Year</label>
            <div class="col-lg-9">
            <input type="number" name="year" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label">Turn Over (N)</label>
            <div class="col-lg-9">
            <input type="number" name="turn_over" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Total Assets (N)</label>
            <div class="col-lg-9">
            <input type="number" name="total_asset" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Total Liability:</label>
            <div class="col-lg-9">
            <input type="number" name="total_liability" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Witholding Tax (N):</label>
            <div class="col-lg-9">
            <input type="number" name="witholding_tax" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Tax Paid (N):</label>
            <div class="col-lg-9">
            <input type="number" name="tax_paid" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">TCC No.:</label>
            <div class="col-lg-9">
            <input type="number" name="tcc_no" required class="form-control">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-lg-3 control-label">Audit Firm:</label>
            <div class="col-lg-9">
            <input name="audit_firm" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">Report Date:</label>
            <div class="col-lg-9">
            <input type="date" name="report_date" required class="form-control">
            <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit"  id ="submitFinance" name="submitFinance" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save Data</button>
        </div>
    </form>
    </div>
    
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>


<script>

    window.addEventListener('load', function () {

        $("#financeForm").submit(function(evt){
            evt.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var host = '{{URL::to('/')}}';
            var dataType =  'JSON';
            $.ajax({ 
                url : host + '/finance/create',
                type : 'POST',
                data :$("#financeForm").serialize(),
                dataType: dataType,
                success:function(response){
                    $('#submitFinance').html('Submitted');
                    $('#submitFinance').attr('disabled', 'disabled');
                    $('#finance_message').show();
                    $('#finance_div').show();
                    $('#finance_message').html(response.success);
                    $('#finance_message').removeClass('d-none');
                    toastr.success(response.success, {timeOut: 1000});

                    
                    document.getElementById("financeForm").reset(); 

                    setTimeout(function(){
                        $('#finance_message').hide();
                        $('#finance_div').hide();
                        $('#submitFinance').html('Save Data');
                        $('#submitFinance').removeAttr('disabled');
                        $('.close').trigger('click');
                    },1000);

                    loadFinances('/finance/finances', function(data){
                    });               
                },
                beforeSend: function(){
                    $('#submitFinance').html('Loading...');
                    $('#submitFinance').attr('disabled', 'disabled');
                },
                error: function(response) {
                    $('#submitFinance').html('Try Again');
                    $('#submitFinance').removeAttr('disabled');
                    toastr.error(response.responseJSON.error); //{timeOut: 5000}  

                
                }
            });
        })
    })


    function deleteFinance(){
        $("#deleteFinance").submit(function(evt){
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
                url : url + '/finance/delete',
                data :$('#deleteFinance').serialize(),
                dataType: dataType,
                success:function(data){    
                    document.getElementById("deleteFinance").reset(); 
                    $('#financeBtn').html('Delete');
                    $('#financeBtn').removeAttr('disabled');
                    loadFinances('/finance/finances', function(data){
                    });

                },
                beforeSend: function(){
                    $('#financeBtn').html('Sending..');
                    $('#financeBtn').attr('disabled', 'disabled');
                },
                error: function(data) {
                    console.log('error', data)
                    $('#financeBtn').html('Try Again');
                    $('#financeBtn').removeAttr('disabled');
                    
                // show error to end user
                }
            });
        })
    }


    function loadFinances(finances, cb){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = '{{URL::to('/')}}';
        var dataType =  'JSON';
        $.ajax({
            type : 'GET',
            url : url + finances,
            success:function(data){  
                data = data.finances; 
                $('#finances').empty();
                if(data.length > 0){
                    $.each(data, function (i) {
                        $('#finances').append(
                            '<tr>'+
                            '<td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="fids[]" value="'+data[i].id+'"><i></i></label></td>' +
                            '<td>'+data[i].year+'</td>' +
                            '<td>'+data[i].turn_over+'</td>' +
                            '<td>'+data[i].total_asset+'</td>'+
                            '<td>'+data[i].total_liability+'</td>'+
                            '<td>'+data[i].witholding_tax+'</td>'+
                            '<td>'+data[i].tax_paid+'</td>'+
                            '<td>'+data[i].tcc_no+'</td>'+
                            '<td>'+data[i].audit_firm+'</td>'+
                            '<td>'+data[i].report_date+'</td>'+
                            '<td><a href="#" class="active" data-toggle="class"><i class="fa fa-edit text-success text-active"></i><i class="fa fa-times text-danger text"></i></a></td>'+
                            '</tr>'
                        );
                    });
                }
                else {
                    $('#finances').append(
                        '<tr>'+
                        '<td colspan="10"><label class="checkbox m-l m-t-none m-b-none i-checks">No Record found</label></td>' +
                        '</tr>'
                    );
                }
            },
        });   
    }
 </script>