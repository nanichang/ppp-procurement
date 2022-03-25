<section class="panel panel-default">
    <header class="panel-heading">
        Category
    </header>
    <form class="bs-example form-horizontal"  id="deleteCategory" method="POST">
    @if(!$disableCrud)
        <div class="row wrapper">
            <div class="col-sm-5 m-b-xs">
            <a href="#addBusinessCategory" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Business Category</a> 
            <button type="submit" id="cateBtn" onclick="deleteCategory()" class="btn btn-sm btn-danger">Delete</button>                
            </div>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped">
        <thead>
            <tr>
            <th width="20"><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox"><i></i></label></th>
            <th data-toggle="class">Business Category</th>
            <th>Business Sub-Category</th>
            </tr>
        </thead>
        <tbody id="categories">
            @if(sizeof($allcategories) > 0)
            @foreach ($allcategories as $category)
            <tr>
                <td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="cates[]" value="{{$category['id']}}"><i></i></label></td>
                <td>{{$category->category}}</td>
                <td>{{$category->sub_category_name}}</td>
              
            </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="5"><label class="checkbox m-l m-t-none m-b-none i-checks">No Record Found</label></td>
                </tr>
            @endif

        </tbody>
        </table>
    </div>
</form>
</section>

<div class="modal fade" id="addBusinessCategory">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Select a category associated with your business</h4>
    </div>
    <div class="modal-body">
    <form class="bs-example form-horizontal" id="categoryform" method="POST">
        <div class="alert alert-success d-none" id="cat_div">
            <span id="cat_message"></span>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">Select a Category</label>
            <div class="col-lg-10">
            <!-- <select name="category" class="form-control">
            @foreach ($business_cates as $category)

                <option value="{{$category->name}}">{{$category->name}}</option>

            @endforeach
            </select> -->
            {!! Form::select('category', $vehicleMakes, 'default', array('id' => 'business_category_id', 'required' => 'required', 'class' => 'form-control')) !!}

            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">Select Sub-Category</label>
            <div class="col-lg-10">
            
            {!! Form::select('subcategory_1', $vehicleModels, 'default', array('id' => 'sub_category', 'required' => 'required', 'class' => 'form-control')) !!}

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


<script type="application/javascript">
    var make_model_mapping = {!! $jsArray !!};

    window.addEventListener('load', function () {

        $('#business_category_id').on('change', function (e) {
			    var options = $("#sub_category").empty().html(' ');
				$.each(make_model_mapping[this.value], function() {
				    options.append($("<option />").val(this.id).text(this.name));
				});
			});

        $("#categoryform").submit(function(evt){
            evt.preventDefault();
            $cat = $('#business_category_id').val();
            if($cat == 'default'){
                alert('Category is compulsory');
                return;
            }
            $subcat = $('#sub_category').val();
            if($subcat == 'default'){
                alert('Sub Category is compulsory');
                return;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = '{{URL::to('/')}}';
            var dataType =  'JSON';
            $.ajax({
                type : 'POST',
                url : url + '/category/create',
                data :$('#categoryform').serialize(),
                dataType: dataType,
                success:function(response){   
                    $('#categoryBtn').html('Submitted');
                    $('#cat_message').show();
                    $('#cat_message').html(response.success);
                    $('#cat_div').show();
                    $('#cat_div').removeClass('d-none');
                    setTimeout(function(){
                        $('.close').trigger('click');
                        $('#cat_message').hide();
                        $('#cat_div').hide();
                        $('#categoryBtn').html('Save Data');
                        $('#categoryBtn').removeAttr('disabled');
                        document.getElementById("categoryform").reset(); 
                    },1000);
                    toastr.success(response.success, {timeOut: 1000});


                    loadCategories('/category/categories', function(response){
                    });
                },
                beforeSend: function(){
                    $('#categoryBtn').html('Sending..');
                    $('#categoryBtn').attr('disabled', 'disabled');
                },
                error: function(response) {
                    $('#categoryBtn').html('Try Again');
                    $('#categoryBtn').removeAttr('disabled');
                    toastr.error(response.responseJSON.error); //{timeOut: 5000}  

                    
                // show error to end user
                }
            });
        })
    });

    function loadCategories(categories, cb){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = '{{URL::to('/')}}';
        var dataType =  'JSON';
        $.ajax({
            type : 'GET',
            url : url + categories,
            success:function(data){  
                data = data.categories; 
                $('#categories').empty();
                if(data.length > 0) {
                    $.each(data, function (i) {
                        $('#categories').append(
                            '<tr>'+
                            '<td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="cates[]" value="'+data[i].id+'"><i></i></label></td>' +
                            '<td>'+data[i].category+'</td>' +
                            '<td>'+data[i].sub_category_name+'</td>' +
                            '</tr>'
                        );
                    });
                }
                else {
                    $('#categories').append(
                        '<tr>'+
                        '<td colspan="5"><label class="checkbox m-l m-t-none m-b-none i-checks">No Record found</label></td>' +
                        '</tr>'
                    );
                }
                  
            },
        });   
    }

    function deleteCategory(){
    $("#deleteCategory").submit(function(evt){
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
            url : url + '/category/delete',
            data :$('#deleteCategory').serialize(),
            dataType: dataType,
            success:function(data){    
                document.getElementById("deleteCategory").reset(); 
                $('#cateBtn').html('Delete');
                $('#cateBtn').removeAttr('disabled');
               
                loadCategories('/category/categories', function(data){
                });
                

            },
            beforeSend: function(){
                $('#cateBtn').html('Sending..');
                $('#cateBtn').attr('disabled', 'disabled');
            },
            error: function(data) {
                $('#cateBtn').html('Try Again');
                $('#cateBtn').removeAttr('disabled');
                
            // show error to end user
            }
        });
    })

}
</script>