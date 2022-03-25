@extends('layouts.admin')
@section('tools')
active
@endsection
@section('content')
<section class="panel panel-default">
    <header class="panel-heading">
        Company Ownership
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
    <form class="bs-example form-horizontal"  id="deleteCategory" method="POST">
    {{csrf_field()}}
    <div class="row wrapper">
        <div class="col-sm-5 m-b-xs">
        <a href="#addBusinessCategory" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Company Ownership</a> 
        <!-- <button type="submit" id="cateBtn"  class="btn btn-sm btn-danger">Delete</button>                 -->
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped b-t b-light">
        <thead>
            <tr>
            <th data-toggle="class">S/N</th>
            <th>Name</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody id="categories">
        <?php  $i = 0; ?>
            @foreach ( $companyOwnership as $data)
            <tr>
                <td>{{ 1 + $i++ }}</td>
                <td>{{ $data['name'] }}</td>
                <td>
                <!-- <a href="#editBusinessCategory" data-toggle="modal" class="btn btn-sm btn-success"><i class="fa fa-edit"></i>Edit</a>  -->
                    <button type="submit" id="cateBtn"  class="btn btn-sm btn-danger">Delete</button>                
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    <footer class="panel-footer">
        <div class="row">
        
        </div>
    </footer>
</form>
</section>

<div class="modal fade" id="addBusinessCategory">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add Company Ownership</h4>
    </div>
    <div class="modal-body">
    <form class="bs-example form-horizontal" action="{{ route('storeCompanyOwnership') }}" method="POST">
    {{csrf_field()}}
        <div class="alert alert-success d-none" id="cat_div">
            <span id="cat_message"></span>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">Company Ownership</label>
            <div class="col-lg-10">
            <input type="text" class="form-control" name="name" placeholder="Company Ownership" value="">
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

<div class="modal fade" id="editBusinessCategory">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Edit Company Ownership</h4>
    </div>
    <div class="modal-body">
    <form class="bs-example form-horizontal" action="{{ route('storeCompanyOwnership') }}" method="POST">
    {{csrf_field()}}
        <div class="alert alert-success d-none" id="cat_div">
            <span id="cat_message"></span>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">Company Ownership</label>
            <div class="col-lg-10">
            <input type="text" class="form-control" name="name" placeholder="Company Ownership" value="">
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

@endsection