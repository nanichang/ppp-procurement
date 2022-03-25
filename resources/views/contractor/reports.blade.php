@extends('layouts.admin')

@section('content')
<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
    <section class="panel panel-info">
                <header class="panel-heading">
                Adverts
                </header>
                <div class="row wrapper">
                <div class="col-sm-9 m-b-xs">
                    <a href="#addNewMDA" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Create New</a> 
                    <button class="btn btn-sm btn-danger">Delete</button>                
                </div>
                  <div class="col-sm-3">
                    <div class="input-group">
                      <input type="text" class="input-sm form-control" placeholder="Search">
                      <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                  <thead>
                        <tr>
                        <th width="20"><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox"><i></i></label></th>
                        <th data-toggle="class">Company name</th>
                        <th>CAC RC NO</th>
                        <th>TIN NO</th>
                        <th>ITF NO</th>
                        <th>Structure</th>
                        <th>Preview</th>
                        <th width="200">#</th>
                        </tr>
                    </thead>
                    <tbody>
            <tr>
            <td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>2017</td>
            <td>2017 Capital Project For the Ministry</td>
            <td>National Competitive Bidding</td>
            <td>0</td>
            <td>
                2017-08-20
            </td>
            <td>
               2017-08-27
            </td>
            <td>
                <a href="#addNewLot" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-file"></i></a> 
                <a href="#" class="btn btn-default"><i class="fa fa-edit"></i></a>
                <a href="#" class="btn btn-default"><i class="fa fa-eye"></i></a>
                <a href="#" class="btn btn-default"><i class="fa fa-gear"></i></a>
            </td>
            </tr>
        </tbody>
                  </table>
                </div>
                
              </section>

<div class="modal fade" id="addNewMDA">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Advert Details</h4>
    </div>
    <div class="modal-body">
    <form class="bs-example form-horizontal">
        
    <div class="form-group">
        <label class="col-lg-3 control-label">Project Title</label>
        <div class="col-lg-9">
        <input name="name" class="form-control">
        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Budget Year</label>
        <div class="col-lg-9">
        <input type="text" name="budget_year" class="form-control">
        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Advert Type</label>
        <div class="col-lg-9">
        <select name="advert_type" class="form-control">
            <option value="default"></option>
        </select>
        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Advert Mode</label>
        <div class="col-lg-9">
        <select name="advert_mode" class="form-control">
            <option value="default"></option>
        </select>
        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Introduction</label>
        <div class="col-lg-9">
        <textarea name="introduction" class="form-control"></textarea>
        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Advert Publish Date</label>
        <div class="col-lg-9">
        <input type="date" name="advert_publish_date" class="form-control">
        <!-- <span class="help-block m-b-none">URL</span> -->
        </div>
    </div>


    <div class="form-group">
        <label class="col-lg-3 control-label">Bid Opening Date</label>
        <div class="col-lg-9">
        <input type="date" name="bid_opening_date" class="form-control">
        <!-- <span class="help-block m-b-none">URL</span> -->
        </div>
    </div>

    </form>
    </div>
    <div class="modal-footer">
      <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
      <a href="#" class="btn btn-sm btn-success">Save Data</a>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>




<div class="modal fade" id="addNewLot">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Add New Lot<small>2017 Capital Project For the Ministry</small></h4>
    </div>
    <div class="modal-body">
    <form class="bs-example form-horizontal">
    
    <div class="form-group">
    <div class="col-sm-10">
      <label class="checkbox-inline i-checks">
        <input name="project_status" type="radio" id="inlineCheckbox1" value="approved_project"><i></i> Approved Project
      </label>
      <label class="checkbox-inline i-checks">
        <input type="radio" id="inlineCheckbox2" value="new_project"><i></i> New Project
      </label>
    </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Select Project</label>
        <div class="col-lg-9">
        <select name="project" class="form-control">
            <option value="default"></option>
        </select>
        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
        </div>
    </div>
        
    <div class="form-group">
        <label class="col-lg-3 control-label">Package No:</label>
        <div class="col-lg-9">
        <input name="package_no" class="form-control">
        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Lot No:</label>
        <div class="col-lg-9">
        <input name="lot_no" class="form-control">
        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Lot Description</label>
        <div class="col-lg-9">
        <input type="text" name="description" class="form-control">
        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Lot Category</label>
        <div class="col-lg-9">
        <select name="lot_category" class="form-control">
            <option value="default"></option>
        </select>
        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Lot Mode</label>
        <div class="col-lg-9">
        <select name="advert_mode" class="form-control">
            <option value="default"></option>
        </select>
        <!-- <span class="help-block m-b-none">Example block-level help text here.</span> -->
        </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Lot Amount</label>
        <div class="col-lg-9">
        <input type="date" name="lot_amount" class="form-control">
        <!-- <span class="help-block m-b-none">URL</span> -->
        </div>
    </div>


    <div class="form-group">
        <label class="col-lg-3 control-label">Upload Tender Document</label>
        <div class="col-lg-9">
        <input type="file" name="tender_document" class="form-control">
        <!-- <span class="help-block m-b-none">URL</span> -->
        </div>
    </div>

    <div class="form-group">
    <div class="col-sm-10">
      <label class="checkbox-inline i-checks">
        <input name="custom_requirement" type="radio" id="inlineCheckbox1" value="approved_project"><i></i> Customer Requirement
      </label>
      <label class="checkbox-inline i-checks">
        <input name="custom_requirement" type="radio" id="inlineCheckbox2" value="new_project"><i></i> No Requirement
      </label>
    </div>
    </div>

    <div class="form-group">
        <label class="col-lg-3 control-label">Requirements</label>
        <div class="col-lg-9">
        <input type="text" class="form-control">
        <!-- <span class="help-block m-b-none">URL</span> -->
        </div>
    </div>

  

    </form>
    </div>
    <div class="modal-footer">
      <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
      <a href="#" class="btn btn-sm btn-success">Save Data</a>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
        </section>
    </section>
</section>
</section>
@endsection
