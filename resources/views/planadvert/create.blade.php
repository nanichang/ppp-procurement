@extends(getUserRole() == 'mda' ? 'layouts.mda' : 'layouts.admin') @section('alladvert') active @endsection @section('content')
<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
            <section class="panel panel-default">
                <header class="panel-heading">
                    <h1>{{ $project['project_description'] }}</h1>
                    @if(!$project['approval_status'])
                    <a href="#deletePlan" data-toggle="modal" class="btn btn-danger btn-sm pull-right"> Delete </a>
                    @endif
                </header>
                <div class="table">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th data-toggle="class">DESCRIPTION</th>
                                <th>Package Number</th>
                                <th>Procurement Method</th>
                                <th>Budgetary Amount in Naira</th>
                                <th>Bid Invitation Date</th>
                                <th>Bid Closing-Opening</th>
                                <th>Action Party</th>
                                <th>Champion</th>
                            </tr>   
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="">{{ $project['project_description'] }}</a></td>
                                <td>{{ strtoupper($project['package_number']) }}</td>
                                <td>{{ ucwords($project['procurement_method']) }}</td>
                                <td>&#x20A6;{{ $project['budgetry_amount'] }}</td>
                                <td>{{ $project['bid_invitation_date'] }}</td>
                                <td>{{ $project['bid_closing_date'] }}</td>
                                <td>{{ $project['action_party'] }}</td>
                                <td>{{ $project['champion'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div>
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr>
                                    <th>Lot Number</th>
                                    <th>Lumpsum or Bill of Quantities</th>
                                    <th>Pre-or Post Qualification</th>
                                    <th>Approval Thresholds</th>
                                    <th>Prep & Submission by MDAs</th>
                                    <th>MDA Approval</th>
                                    <th>Advertisement for Pre-Qualification</th>
                                    <th>Submission Bid Eval Rpt</th>
                                    <th>MDA Approval</th>
                                    <th>Contract Amount Certified in Naira</th>
                                    <th>SEC Approval</th>
                                    <th>Date of Contract Offer</th>
                                    <th>Date Contract Signature</th>
                                    <th>Mobilization Advance Payment</th>
                                    <th>Final Acceptance</th>
                                    <th>Final Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ strtoupper($project['lot_number']) }}</td>
                                    <td>{{ $project['lumpsum'] }}</td>
                                    <td>{{ $project['pre_post_qualification'] }}</td>
                                    <td>{{ strtoupper($project['approval_threshold']) }}</td>
                                    <td>{{ $project['prep_submissions_by_mda'] }}</td>
                                    <td>{{ $project['mda_approval'] }}</td>
                                    <td>{{ $project['advertisement_for_pre_qualification'] }}</td>
                                    <td>{{ $project['submission_bid_eval_rpt'] }}</td>
                                    <td>{{ $project['mda_approval_2'] }}</td>
                                    <td>&#x20A6; {{ number_format(floatval($project['contract_amount_certified'])) }}</td>
                                    <td>{{ $project['sec_approval'] }}</td>
                                    <td>{{ $project['date_of_contract_offer'] }}</td>
                                    <td>{{ $project['date_of_contract_signature'] }}</td>
                                    <td>&#x20A6; {{ number_format(floatval($project['mobilization_advance_payment'])) }}</td>
                                    <td>{{ $project['final_acceptance'] }}</td>
                                    <td>&#x20A6; {{ number_format(floatval($project['final_cost'])) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <section class="panel panel-info">
                <header class="panel-heading">
                    Adverts
                </header>
                <form class="bs-example form-horizontal" id="deleteAdverts" action="javascript:void(0)" method="POST">
                    <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />

                    <div class="row wrapper">
                        <div class="col-sm-9 m-b-xs">
                            @if(getUserRole() == 'mda') @if($project['approval_status'] == 1)
                            <a href="#" id="addNewMDAA" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Create New</a>
                            <button type="submit" disabled id="advertsBtn" onclick="deleteAdvert()" class="btn btn-sm btn-danger">Delete</button>
                            @endif @endif
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" class="input-sm form-control" placeholder="Search" />
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
                                    <th width="20">
                                        <label class="checkbox m-l m-t-none m-b-none i-checks"><input disabled="disabled" type="checkbox" /><i></i></label>
                                    </th>
                                    <th data-toggle="class">Budget Year</th>
                                    <th>Project Title</th>
                                    <th>MDA</th>
                                    <th>Lots</th>
                                    <th>Bid Opening Date</th>
                                    <th>Closing Date</th>
                                    <th>Approval Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody id="adverts">
                                @if(sizeof($project->adverts) > 0) @foreach($project->adverts as $advert)

                                <tr>
                                    <td>
                                        <label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="aids[]" value="{{$advert->id}}" /><i></i></label>
                                    </td>
                                    <td>{{$advert->budget_year}}</td>
                                    <td>{{$advert->name}}</td>
                                    <td>{{ getMdaName($advert->mda_id)->name }}</td>
                                    <td id="lots">{{count($advert->advertLots)}}</td>
                                    <td>{{$advert->bid_opening_date}}</td>
                                    <td>{{$advert->closing_date}}</td>
                                    <td>
                                        @if($advert->approval_status == 1) Approved @else Awaiting Approval @endif
                                    </td>
                                    <td>
                                        <!--<a href="#" data-id="{{ $advert->id }}" data-name="{{ $advert->name}}" class="btn btn-sm btn-primary addNewLot"><i class="fa fa-file"></i></a>-->
                                        <!-- <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a> -->
                                        <a href="{{route('create-plan-advert.preview', $advert->id)}}" class="btn btnLink btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach @else
                                <tr>
                                    <td colspan="8">NO ADVERT FOUND</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </form>
            </section>
        </section>
    </section>
</section>
<div class="modal fade" id="addNewMDA">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Advert Details</h4>
            </div>
            <div class="modal-body">
                <form id="form" class="bs-example form-horizontal" action="{{ route('create-plan-advert.store', $project->id) }}" method="POST" enctype="multipart/form-data">
                    <div class="alert alert-success d-none" id="advert_div">
                        <span id="advert_message"></span>
                    </div>
                    @csrf
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Project Title</label>
                        <div class="col-lg-9">
                            <input value="{{ $project->project_description }}" disabled class="form-control" />
                            <input type="hidden" name="name" value="{{ $project->project_description }}" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Advert Description</label>
                        <div class="col-lg-9">
                            <textarea name="advert_plan_desc" required class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Advert Introduction</label>
                        <div class="col-lg-9">
                            <textarea name="introduction" required class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                  <label class="col-lg-3 control-label">Advert Type</label>
                  <div class="col-lg-9">
                  {!! Form::select('advert_type', $vehicleMakes, 'default', array('id' => 'advert_type_id', 'required' => true, 'class' => 'form-control')) !!}

                    <!-- <select name="advert_type" required class="form-control">
                      <option value="national competitive bidding">National Competitive Bidding</option>
                    </select> -->
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-lg-3 control-label">Advert Mode</label>
                  <div class="col-lg-9">
                  {!! Form::select('advert_mode', $vehicleModels, 'default', array('id' => 'advertMode', 'required' => true, 'class' => 'form-control')) !!}

                    <!-- <select name="advert_mode" required class="form-control">
                      <option value="invitation to tender">Invitation to Tender</option>
                    </select> -->
                  </div>
                </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Bid Closing Date</label>
                        <div class="col-lg-9">
                            <div class='input-group date' id='datetimepicker1'>
                                <input type="text" required name="closing_date" class="form-control"/>
                                <span class="input-group-addon add-on">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <small id="closing_date_help" class="form-text text-muted">Click Calendar to pick date. <b>Note:</b> Time is in 24hrs format</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Bid Opening Date</label>
                        <div class="col-lg-9">
                            <div class='input-group date' id='datetimepicker2'>
                                <input type='text' required name="bid_opening_date" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <small id="closing_date_help" class="form-text text-muted">Click Calendar to pick date. <b>Note:</b> Time is in 24hrs format</small>
                        </div>
                    </div>

                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="year_id" value="{{ $project->year_id }}" />
                    <input type="hidden" name="mda_id" value="{{ $project->mda_id }}" />
                    <input type="hidden" name="procurement_plan_id" value="{{ $project->id }}" />
                    <input type="hidden" name="budget_year" value="{{ $year->year }}" />

                    <div class="form-group" id="addform" style="padding: 0px 15px 0px 15px;">
                        <div class="col-md-6">
                            <label for="document_title" class="control-label">Document Title </label>
                            <input type="text" name="document_title[]" class="form-control" />
                        </div>
                        <div class="col-md-6">
                            <label for="advert_document" class="control-label">Select Document</label>
                            <input type="file" name="advert_document[]" multiple class="form-control" />
                        </div>
                    </div>
                    <button class="btn add-btn">Add Document</button>
                    <br />
                    <br />

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade newLotModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Lot <small id="headerTitle"> </small></h4>
            </div>
            <div class="modal-body">
                <form class="bs-example form-horizontal" id="lotForm" action="javascript:void(0)" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="advert_id" id="advert_id" required class="form-control" />

                    <div class="alert alert-success d-none" id="lot_div">
                        <span id="lot_message"></span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10 hidden">
                            <!-- <label class="checkbox-inline i-checks">
                      <input name="project_status" onclick="show2()" type="radio" id="inlineCheckbox1" value="approved_project"><i></i> Approved Project
                    </label> -->
                            <label class="checkbox-inline i-checks"> <input name="project_status" checked="true" onclick="show1()" type="radio" id="inlineCheckbox2" value="new_project" /><i></i> New Project </label>
                        </div>
                    </div>

                    <div id="div1" class="form-group hidden">
                        <label class="col-lg-3 control-label">Select Project</label>
                        <div class="col-lg-9">
                            <select name="project_name" class="form-control">
                                <option value="default"></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Package No:</label>
                        <div class="col-lg-9">
                            <input name="package_no" required class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Lot No:</label>
                        <div class="col-lg-9">
                            <input name="lot_no" required class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Lot Description</label>
                        <div class="col-lg-9">
                            <textarea type="text" required name="description" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Lot Category</label>
                        <div class="col-lg-9">
                            <select name="lot_category" required class="form-control">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Lot Amount</label>
                        <div class="col-lg-9">
                            <input type="number" required name="lot_amount" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Upload Tender Document</label>
                        <div class="col-lg-9">
                            <input type="file" required id="tender_document" name="tender_document" class="form-control" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                        <button type="submit" id="saveLot" name="saveLot" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="application/javascript">

    var make_model_mapping = {!! $jsArray !!};

    window.addEventListener('load', function () {

        $('#advert_type_id').on('change', function (e) {
			    var options = $("#advertMode").empty().html(' ');
				$.each(make_model_mapping[this.value], function() {
				    options.append($("<option />").val(this.id).text(this.name));
				});
			});
    });

    $(document).ready(function () {
        // allowed maximum input fields
        var max_input = 5;

        // initialize the counter for textbox
        var x = 1;

        // handle click event on Add More button
        $(".add-btn").click(function (e) {
            e.preventDefault();
            if (x < max_input) {
                // validate the condition
                x++; // increment the counter
                $("#addform").append(`
                    <div class="form-group" style="padding: 0px 15px 0px 15px;">
                        <div class="col-md-6">
                            <label for="document_title" class="control-label">Document Title </label>
                            <input type="text" name="document_title[]" class="form-control"/>
                        </div>
                        <div class="col-md-6">
                            <label for="advert_document" class="control-label">Select Document</label>
                            <input type="file" name="advert_document[]" multiple class="form-control">
                        </div>
                        <a href="#" class="remove-lnk" style="margin-left: 15px; color: red;">Remove</a>
                    </div>
                  `); // add input field
            }
        });

        // handle click event of the remove link
        $("#addform").on("click", ".remove-lnk", function (e) {
            e.preventDefault();
            $(this).parent("div").remove(); // remove input field
            x--; // decrement the counter
        });
    });

    function loadAdverts(adverts, cb) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        //var url = "{{URL::to(" / ")}}";
        var dataType = "JSON";
        $.ajax({
            type: "GET",
            url: adverts,
            success: function (data) {
                data = data.adverts;
                $("#adverts").empty();
                $.each(data, function (i) {
                    $("#adverts").append(
                        "<tr>" +
                            '<td><label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="aids[]" value="' +
                            data[i].id +
                            '"><i></i></label></td>' +
                            "<td>" +
                            data[i].budget_year +
                            "</td>" +
                            "<td>" +
                            data[i].name +
                            "</td>" +
                            "<td>" +
                            data[i].advert_type +
                            "</td>" +
                            "<td>" +
                            data[i].lots +
                            "</td>" +
                            "<td>" +
                            data[i].advert_publish_date +
                            "</td>" +
                            "<td>" +
                            data[i].bid_opening_date +
                            "</td>" +
                            "<td>" +
                            '<a href="#" data-id="' +
                            data[i].id +
                            '" data-name="' +
                            data[i].name +
                            '" class="btn btn-sm btn-primary addNewLot"><i class="fa fa-file"></i></a>' +
                            '<a href="#" class="btn btnLink btn-sm btn-warning"><i class="fa fa-edit"></i></a>' +
                            // '<a href="#" class="btn btnLink btn-sm btn-success"><i class="fa fa-eye"></i></a>'+
                            '<a href="/mda/advert/bidrequirement/' +
                            data[i].id +
                            '/" class="btn btnLink btn-sm btn-danger"><i class="fa fa-gear"></i></a>' +
                            "</td>" +
                            "</tr>"
                    );
                    location.reload();
                });
            },
        });
    }

    function deleteAdvert() {
        $("#deleteAdverts").submit(function (evt) {
            evt.preventDefault();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            //var url = "{{URL::to(" / ")}}";
            var dataType = "JSON";

            $.ajax({
                type: "POST",
                url: "/advert/delete",
                data: $("#deleteAdverts").serialize(),
                dataType: dataType,
                success: function (data) {
                    $("#advertsBtn").html("Delete");
                    $("#advertsBtn").removeAttr("disabled");
                    loadAdverts("/advert/adverts/{{$project['id']}}", function (data) {});
                },
                beforeSend: function () {
                    $("#advertsBtn").html("Sending..");
                    $("#advertsBtn").attr("disabled", "disabled");
                },
                error: function (data) {
                    $("#advertsBtn").html("Try Again");
                    $("#advertsBtn").removeAttr("disabled");
                },
            });
        });
    }

    function show1() {
        document.getElementById("div1").style.display = "none";
    }

    function show2() {
        document.getElementById("div1").style.display = "block";
    }

    window.addEventListener("load", function () {
        $(".addNewLot").on("click", function (evt) {
            evt.preventDefault();
            var currentId = $(this).attr("data-id");
            var name = $(this).attr("data-name");
            $("#headerTitle").html(" " + name);
            $("#advert_id").val(currentId);

            if (!currentId) {
                console.log("Bug");
                return;
            }

            $(".newLotModal").modal("show");
        });
    });

    window.addEventListener("load", function () {
        $("#lotForm").submit(function (evt) {
            evt.preventDefault();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            //var url = "{{URL::to(" / ")}}";
            var dataType = "JSON";
            $.ajax({
                type: "POST",
                url: "/advert-lot/create",
                data: new FormData(this),
                contentType: false,
                processData: false,
                // data :$('#lotForm').serialize(),
                // data : new FormData($("#lotForm")[0]),
                dataType: dataType,

                success: function (data) {
                    $("#saveLot").html("Submitted");
                    $("#saveLot").removeAttr("disabled");
                    $("#lot_message").show();
                    $("#lot_div").show();
                    $("#lot_message").html(data.success);
                    $("#lot_div").removeClass("d-none");
                    document.getElementById("lotForm").reset();
                    setTimeout(function () {
                        $("#lot_message").hide();
                        $("#lot_div").hide();
                        $("#saveLot").html("Save Data");
                        $(".close").trigger("click");
                    }, 1000);

                    loadAdverts("/advert/adverts{{$project['id']}}", function (data) {});
                },
                beforeSend: function () {
                    $("#saveLot").html("Sending..");
                    $("#saveLot").attr("disabled", "disabled");
                },
                error: function (data) {
                    console.log("error", data);
                    $("#saveLot").html("Try Again");
                    $("#saveLot").removeAttr("disabled");

                    // show error to end user
                },
            });
        });
    });

    window.addEventListener("load", function () {
        $(document).ready(function () {
            var sumchecked = 0;
            $("#adverts").on("change", 'input[type="checkbox"]', function () {
                $(this).is(":checked") ? sumchecked++ : sumchecked--;
                sumchecked > 0 ? $("#advertsBtn").removeAttr("disabled") : $("#advertsBtn").attr("disabled", "disabled");
            });
        });
    });

    // window.addEventListener('load', function () {
    //  let data = document.getElementById('lots').innerHTML
    //  if(Number(data) > 0 ) {
    //   return $('.btnLink').removeClass('disabled');
    //  }

    //});
</script>

<div class="modal fade" id="deletePlan">
    <div class="modal-dialog">
        <form class="bs-example form-horizontal" method="post" action="{{route('procurementPlan.delete', $project->id)}}">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Are you sure?</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="alert alert-success d-none" id="mdas_div">
                        <span id="mdas_message"></span>
                    </div>
                    This will delete the procurement plan if there is no record dependencies.
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Yes... Delete</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script type="application/javascript">
    window.addEventListener('load', function () {

      $("#addNewMDAA").on('click', function(evt){
        evt.preventDefault();
        $("#addNewMDA").modal('show');
        $('#datetimepicker1').datetimepicker({
            format : 'YYYY-MM-DD HH:mm'
        });
        $('#datetimepicker2').datetimepicker({
          format : 'YYYY-MM-DD HH:mm'
        });
      });

    });
   </script>
@endsection
