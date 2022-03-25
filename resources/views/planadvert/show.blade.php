@extends(getUserRole() == 'mda' ? 'layouts.mda' : 'layouts.admin')
@section('getmdas')
active
@endsection

@section('content')
<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
            <br/>
            <section class="panel panel-default">
                <header class="panel-heading">
                    {{ $advert->name }} by {{ getMdaName($advert->mda_id)->name }} // Documents uploaded
                    <a href="{{route('create-plan-advert', $advert->procurement_plan_id)}}" class="btn btn-success btn-sm pull-right" style="margin-left: 5px;"> Plan </a>
                    @if(\Carbon\Carbon::parse($advert->closing_date)->lt(\Carbon\Carbon::now()))
                        <a href="{{ route('viewAdvertOpeningById', $advert->id) }}" class="btn btn-success btn-sm pull-right" style="margin-left: 5px;"> Open Bids </a>
                    @endif
                    @if(getUserRole() == 'admin' && $advert->approval_status == true)
                        <a href="{{route('adminAdPublicationPage', $advert->id)}}" class="btn btn-success btn-sm pull-right"> Publication </a>
                    @elseif($advert->approval_status == true)
                        <a href="{{route('mdaAdPublicationPage', $advert->id)}}" class="btn btn-success btn-sm pull-right"> Publication </a>
                    @endif
                </header>
                <div class="panel-body">
                    <div class="container">
                        @if(getUserRole() == 'admin' && $advert->approval_status == false && $advert->status != 'active')
                            <a href="#approveAdvert" data-toggle="modal" class="btn btn-success">Approve Advert</a>
                        @elseif(getUserRole() == 'admin' && $advert->approval_status == true && $advert->status != 'active' )
                            <a href="#disapproveAdvert" data-toggle="modal" class="btn btn-danger">Disapprove Advert</a>
                        @endif
                    </div>
                    <div class="row">
                        @foreach($docs as $doc)
                        <div class="col-md-6 text-center" style="padding: 8px;">
                            <a href="{{ Storage::disk('s3')->url($doc->document_url) }}" class="btn btn-s-md btn-primary btn-rounded"><i class="fa fa-file"></i> CAC</a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <section class="panel panel-default">
                <header class="panel-heading">
                Advert Lots
                </header>
                <div class="panel-body">
                    <div class="row">
                    <form class="bs-example form-horizontal" action="{{route('deleteAdvertLot')}}" method="POST">
                        <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
                        @if(!$advert->approval_status)
                        <div class="row wrapper">
                            <div class="col-sm-9 m-b-xs">
                                @if(getUserRole() == 'mda')
                                    <a href="#addNewLot" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Create New</a>
                                    <button type="submit" disabled id="btnDeleteAdsLot" class="btn btn-sm btn-danger">Delete</button>
                                @endif
                            </div>
                        </div> 
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped b-t b-light">
                                <thead>
                                    <tr>
                                        <th width="20">
                                            <label class="checkbox m-l m-t-none m-b-none i-checks"><input disabled="disabled" type="checkbox" /><i></i></label>
                                        </th>
                                        <th>Package No.</th>
                                        <th>Lot No.</th>
                                        <th>Lot Amount</th>
                                        <th>Description</th>
                                        <th>Tender Document</th>
                                        @if($advert->approval_status == true && $advert->status == 'active' && \Carbon\Carbon::parse($advert->closing_date)->lt(\Carbon\Carbon::now()))
                                            <th>Action</th>
                                        @endif
                                        
                                    </tr>
                                </thead>
                                <tbody id="adlots">
                                    @if(sizeof($advert->advertLots) > 0)
                                    @foreach($advert->advertLots as $al)
                                    <tr>
                                        <td>
                                            <label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="lids[]" value="{{$al->id}}" /><i></i></label>
                                        </td>
                                        <td>{{$al->package_no}}</td>
                                        <td>{{$al->lot_no}}</td>
                                        <td>{{number_format($al->lot_amount, 2)}}</td>
                                        <td>{{$al->description}}</td>
                                        <td>
                                            @if($al->tender_document)
                                                <a href="{{ Storage::disk('s3')->url($al->tender_document) }}" class="btn btn-s-md btn-primary btn-rounded"><i class="fa fa-file"></i> Tender Document</a>
                                            @endif
                                            @if($al->tender_document_inhouse)
                                                <a href="{{ Storage::disk('s3')->url($al->tender_document_inhouse) }}" class="btn btn-s-md btn-primary btn-rounded"><i class="fa fa-file"></i> In House Tender Document</a>
                                            @endif
                                        </td>
                                        
                                        @if($advert->approval_status == true && $advert->status == 'active' && getUserRole() == 'mda' && \Carbon\Carbon::parse($advert->closing_date)->lt(\Carbon\Carbon::now()))
                                            <td>
                                                <a href="{{ route('evaluator.index', ['lot_id' => $al->id]) }}" class="btn btn-sm btn-primary btn-rounded">
                                                    <i class="fa fa-plus"></i> Show / add Evaluators
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8">NO LOTS FOR THIS ADVERT</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </form>
                    </div>
                </div>
            </section>

            <!--
            <section class="panel panel-default">
                <header class="panel-heading">
                    {{ $advert->name }}
                </header>
                <div class="row wrapper">
                    <div class="col-sm-9 m-b-xs">
                    @if(getUserRole() == 'admin')
                        <a href="#approveAdvert" data-toggle="modal" class="btn btn-success">Approve Documents</a>
                    @endif
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Budget Year</th>
                                    <th>MDA</th>
                                    <th>Bid Opening Date</th>
                                    <th>Closing Date</th>
                                    <th>Approval Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $advert->name }}</td>
                                    <td>{{ $advert->budget_year }}</td>
                                    <td>{{ getMdaName($advert->mda_id)->name }}</td>
                                    <td>{{ $advert->bid_opening_date }}</td>
                                    <td>{{ $advert->closing_date }}</td>
                                    <td>{{ ($advert->approval_status == 1) ? "Approved" : "Pending" }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            -->
            @if(getUserRole() == 'mda' || getUserRole() == 'admin')
            <section class="panel panel-info">
                <header class="panel-heading">
                    Advert Criteria
                </header>
                <form class="bs-example form-horizontal" action="{{route('deleteAdvertCriteria')}}" method="POST">
                    <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
                    @if(!$advert->approval_status)
                    <div class="row wrapper">
                        <div class="col-sm-9 m-b-xs">
                            @if(getUserRole() == 'mda')
                            <a href="#addNewCriteria" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Create New</a>
                            <button type="submit" disabled id="btnDeleteAdsCriteria" class="btn btn-sm btn-danger">Delete</button>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr>
                                    <th width="20">
                                        <label class="checkbox m-l m-t-none m-b-none i-checks"><input disabled="disabled" type="checkbox" /><i></i></label>
                                    </th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Required</th>
                                </tr>
                            </thead>
                            <tbody id="adscriteria">
                                @if(sizeof($advert->advertCriterias) > 0)
                                @foreach($advert->advertCriterias as $ac)
                                <tr>
                                    <td>
                                        <label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="acids[]" value="{{$ac->id}}" /><i></i></label>
                                    </td>
                                    <td>{{$ac->title}}</td>
                                    <td>{{$ac->description}}</td>
                                    <td>{{$ac->required ? "YES" : "NO"}}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8">NO CRITERIA FOR THIS ADVERT</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </form>
            </section>
            @endif

            @if(sizeof($docs) > 0)
            <section class="panel panel-default">
                <header class="panel-heading">
                    Bidding Documents
                </header>
                <div class="panel-body">
                <form class="bs-example form-horizontal" action="{{route('deleteAdvertDocument')}}" method="POST">
                    <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
                    @if(!$advert->approval_status)
                    <div class="row wrapper">
                        <div class="col-sm-9 m-b-xs">
                            @if(getUserRole() == 'mda')
                            <button type="submit" disabled id="btnDeleteAdsDocument" class="btn btn-sm btn-danger">Delete</button>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr>
                                    <th width="20">
                                        <label class="checkbox m-l m-t-none m-b-none i-checks"><input disabled="disabled" type="checkbox" /><i></i></label>
                                    </th>
                                    <th>Name</th>
                                    <th>Date uploaded</th>
                                </tr>
                            </thead>
                            <tbody id="advert_documents">
                                @foreach($docs as $doc)
                                    <tr>
                                        <td>
                                        <label class="checkbox m-l m-t-none m-b-none i-checks"><input type="checkbox" name="ids[]" value="{{$doc->id}}" /><i></i></label>
                                        <td>{{ strtoupper($doc->document_title) }}</td>
                                        <td>{{ $doc->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                </div>
            </section>
            @endif
            @if(sizeof($contractors) > 0)
            <section class="panel panel-default">
                <header class="panel-heading">
                    Interested Contractors
                </header>
                <div class="panel-body">
                
                @foreach($contractors as $lots)
                    <h2>{{$loop->index + 1}} - {{ strtoupper($lots[0]->contractor_name) }} </h2>
                    <hr/>
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr>
                                    <th>S/N</th>                                    
                                    <th>Lot Description</th>
                                    <th>Amount Paid</th>
                                    <th>Date uploaded</th>
                                </tr>
                            </thead>
                            <tbody id="contractors">
                                @foreach($lots as $contractor)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{ strtoupper($lots[0]->contractor_name) }}</td>
                                        <td>{{ number_format($contractor->amount, 2) }}</td>
                                        <td>{{ $contractor->created_at }}</td>
                                    </tr>
                                @endforeach                                
                            </tbody>
                        </table>
                    </div>
                @endforeach
                </div>
            </section>
            @endif

        </section>

        <div class="modal fade contractorCriteriaModal" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            <h3 id="headerTitle"> </h3>
                        </h4>
                    </div>
                    <div class="modal-body">
                        
                        <form class="bs-example form-horizontal" action="{{ route('submitContractorCriterea') }}"  method="post" enctype="multipart/form-data">
                            
                            <div class="alert alert-warning show">
                                <strong>Contractor</strong>  will move to the next stage if all required criterias are satisfied.
                                
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped b-t b-light">
                                    <thead>
                                        <tr>
                                            <th>
                                               
                                            </th>
                                            <th>Title</th>
                                            <th>Required</th>
                                        </tr>
                                    </thead>
                                    <tbody id="contactorAdscriteria">
                                        @if(sizeof($advert->advertCriterias) > 0)
                                            @foreach($advert->advertCriterias as $ac)
                                                <tr>
                                                    <td>
                                                        <label class="checkbox m-l m-t-none m-b-none i-checks">
                                                            <input type="checkbox" name="acids[]" value="{{$ac->id}}" /><i></i>
                                                        </label>
                                                    </td>
                                                    <td>{{ ucfirst($ac->title) }}</td>
                                                    <td>{{$ac->required ? "YES" : "NO"}}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4">NO CRITERIA FOR THIS ADVERT</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" name="advert_id" id="advert_id">
                            <input type="hidden" name="contractor_id" id="contractor_id">

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Process</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
</section>

<div class="modal fade" id="approveAdvert">
    <div class="modal-dialog">
        <form class="bs-example form-horizontal" method="post" action="{{ route('create-plan-advert.approveAdvert', $advert->id) }}">
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

                    You are about to approve <strong>{{ strtoupper($advert->name) }}</strong> for {{ getMdaName($advert->mda_id)->name }} for the year {{ $advert->budget_year }}?

                    <input type="hidden" name="advert_id" value="{{ $advert->id }}" />

                    <input type="hidden" name="plan_title" value="works" />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Yes... Approve</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="disapproveAdvert">
    <div class="modal-dialog">
        <form class="bs-example form-horizontal" method="post" action="{{ route('create-plan-advert.disapproveAdvert', $advert->id) }}">
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

                    You are about to make this advert editable <strong>{{ strtoupper($advert->name) }}</strong> for {{ getMdaName($advert->mda_id)->name }} for the year {{ $advert->budget_year }}?

                    <input type="hidden" name="advert_id" value="{{ $advert->id }}" />

                    <input type="hidden" name="plan_title" value="works" />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Yes... Make Editable</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="addNewCriteria">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Advert Criteria</h4>
            </div>
            <div class="modal-body">
                <form id="form" class="bs-example form-horizontal" action="{{ route('create-advert-criteria.addCriteria') }}" method="POST">
                    <div class="alert alert-success d-none" id="advert_div">
                        <span id="advert_message"></span>
                    </div>
                    @csrf
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Criteria Title</label>
                        <div class="col-lg-9">
                            <input type="text" name="title" class="form-control" />
                            <input type="hidden" name="advert_id" value="{{ $advert->id }}" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Criteria Description</label>
                        <div class="col-lg-9">
                            <textarea name="description" required class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Required</label>
                        <div class="col-lg-9">
                            <input type="checkbox" name="required" class="form-control" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade newLotModal" id="addNewLot">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Lot <small id="headerTitle"> {{$advert->name}}</small></h4>
            </div>
            <div class="modal-body">
                <form class="bs-example form-horizontal" id="lotForm" action="javascript:void(0)" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="{{$advert->id}}" name="advert_id" id="advert_id" required class="form-control" />

                    <div class="alert alert-success d-none" id="lot_div">
                        <span id="lot_message"></span>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10 hidden">
                            <!-- <label class="checkbox-inline i-checks">
                      <input name="project_status" onclick="show2()" type="radio" id="inlineCheckbox1" value="approved_project"><i></i> Approved Project
                    </label> -->
                            <label class="checkbox-inline i-checks"> 
                            <input name="project_status" checked="true" onclick="show1()" type="radio" id="inlineCheckbox2" value="new_project" /><i></i> New Project </label>
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
                        <label class="col-lg-3 control-label">Cell Position</label>
                        <div class="col-lg-9">
                            <input type="text" name="cell_position" class="form-control" />
                        </div>
                    </div>
                    <!-- Temporary inhouse_bid_amount
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Bid Total Amount (Temp)</label>
                        <div class="col-lg-9">
                            <input type="text" name="inhouse_bid_amount" class="form-control" />
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Upload Tender Document</label>
                        <div class="col-lg-9">
                            <input type="file" required id="tender_document" name="tender_document" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Upload Tender Document (in-house)</label>
                        <div class="col-lg-9">
                            <input type="file" required id="tender_document_inhouse" name="tender_document_inhouse" class="form-control" />
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

<script>

    var make_model_mapping = {!! $jsArray !!};

    window.addEventListener("load", function () {
        $("#lotForm").submit(function (evt) {
            evt.preventDefault();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            var dataType = "JSON";
            $.ajax({
                type: "POST",
                url: "/advert-lot/create",
                data: new FormData(this),
                contentType: false,
                processData: false,
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
                         location.reload();
                    }, 1000);
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

    window.addEventListener('load', function () {
      $(document).ready(function() {
        var acsumchecked = 0;
        $('#adscriteria').on('change', 'input[type="checkbox"]', function(){
          ($(this).is(':checked')) ? acsumchecked++ : acsumchecked--;
          (acsumchecked > 0) ? $('#btnDeleteAdsCriteria').removeAttr('disabled') : $('#btnDeleteAdsCriteria').attr('disabled', 'disabled');
        });

        var adsumchecked = 0;
        $('#advert_documents').on('change', 'input[type="checkbox"]', function(){
          ($(this).is(':checked')) ? adsumchecked++ : adsumchecked--;
          (adsumchecked > 0) ? $('#btnDeleteAdsDocument').removeAttr('disabled') : $('#btnDeleteAdsDocument').attr('disabled', 'disabled');
        });

        var alsumchecked = 0;
        $('#adlots').on('change', 'input[type="checkbox"]', function(){
          ($(this).is(':checked')) ? alsumchecked++ : alsumchecked--;
          (alsumchecked > 0) ? $('#btnDeleteAdsLot').removeAttr('disabled') : $('#btnDeleteAdsLot').attr('disabled', 'disabled');
        });

      });
    });

    window.addEventListener('load', function () {
        $(".showContractorCriteriaModal").on('click', function(evt){
            evt.preventDefault();
            var currentId = $(this).attr('data-id');
            var contractorId = $(this).attr('data-contractor-id');
            var name = $(this).attr('data-name');
            $('#headerTitle').html(' '+name);
            $('#advert_id').val(currentId);
            $('#contractor_id').val(contractorId);
            if(!currentId){
                console.log("Bug");
                return;
            }
            $(".contractorCriteriaModal").modal('show');
        });
    });

</script>

@endsection

