@extends(getUserRole() == 'mda' ? 'layouts.mda' : 'layouts.admin')
@section('procurement-plan')
active
@endsection

@section('content')
<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
            <br/>
            <section class="panel panel-info">
                <header class="panel-heading">
                    <div style="float: left;">Viewing all Submissions for the year: {{ $year->year }}</div>
                    <div style="float: right;">
                        <form method="GET">
                            <select name="plan_type" class="form-control" style="display: inline; width: auto;">
                                    <option value="0" {{$plan_type == 0 ? 'selected="selected"': ''}}>All Records</option>
                                    @foreach($bizCat as $plan)
                                        <option value="{{ $plan->id }}" {{$plan_type == $plan->id ? 'selected="selected"': ''}}>{{$plan->name}}</option>
                                    @endforeach
                            </select>
                            <button class="btn btn-sm btn-primary">Filter</button>
                            @if(getUserRole() == 'mda')
                            <a href="#viewdata" data-toggle="modal" class="btn btn-sm btn-primary">
                                <i class="fa fa-plus"></i> Add A Plan
                            </a>
                            @endif
                        </form>

                    </div>
                    <div style="clear: both;"></div>
                </header>

                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>

                                <th data-toggle="class">DESCRIPTION</th>
                                <th>Package Number</th>
{{--                                <th>Lot Number</th>--}}
{{--                                <th>Lumpsum or Bill of Quantities</th>--}}
                                <th>Procurement Method</th>
                                <th>Budgetary Amount in Naira</th>
{{--                                <th>Pre-or Post Qualification</th>--}}
{{--                                <th>Approval Thresholds</th>--}}
{{--                                <th>Prep & Submission by MDAs</th>--}}
{{--                                <th>MDA Approval</th>--}}
{{--                                <th>Advertisement for Pre-Qualification</th>--}}
                                <th>Bid Invitation Date</th>
                                <th>Bid Closing-Opening</th>
{{--                                <th>Submission Bid Eval Rpt</th>--}}
{{--                                <th>MDA Approval</th>--}}
{{--                                <th>Contract Amount Certified in Naira</th>--}}
{{--                                <th>SEC Approval</th>/--}}
{{--                                <th>Date of Contract Offer</th>--}}
{{--                                <th>Date Contract Signature</th>--}}
{{--                                <th>Mobilization Advance Payment</th>--}}
{{--                                <th>Final Acceptance</th>--}}
{{--                                <th>Final Cost</th>--}}
                                <th>Action Party</th>
                                <th>Champion</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="mdas">
                        <?php  $i = 0; ?>
                        @if(sizeof($plans) > 0)
                            @foreach ($plans as $data)
                                <tr>

                                    <td><a href="">{{ $data['project_description'] }}</a></td>
                                    <td>{{ strtoupper($data['package_number']) }}</td>
{{--                                    <td>{{ strtoupper($data['lot_number']) }}</td>--}}
{{--                                    <td>{{ $data['lumpsum'] }}</td>--}}
                                    <td> {{ ucwords($data['procurement_method']) }}</td>
                                    <td>&#x20A6;{{ number_format(floatval($data['budgetry_amount'])) }}</td>
{{--                                    <td>{{ $data['pre_post_qualification']  }}</td>--}}
{{--                                    <td>{{ strtoupper($data['approval_threshold'])  }}</td>--}}
{{--                                    <td>{{ $data['prep_submissions_by_mda']  }}</td>--}}
{{--                                    <td>{{ $data['mda_approval']  }}</td>--}}
{{--                                    <td>{{ $data['advertisement_for_pre_qualification']  }}</td>--}}
                                    <td>{{ $data['bid_invitation_date']  }}</td>
                                    <td>{{ $data['bid_closing_date']  }}</td>
{{--                                    <td>{{ $data['submission_bid_eval_rpt']  }}</td>--}}
{{--                                    <td>{{ $data['mda_approval_2']  }}</td>--}}
{{--                                    <td>&#x20A6; {{ number_format(floatval($data['contract_amount_certified']))  }}</td>--}}
{{--                                    <td>{{ $data['sec_approval'] }}</td>--}}
{{--                                    <td>{{ $data['date_of_contract_offer'] }}</td>--}}
{{--                                    <td>{{ $data['date_of_contract_signature'] }}</td>--}}
{{--                                    <td>&#x20A6; {{ number_format(floatval($data['mobilization_advance_payment'])) }}</td>--}}
{{--                                    <td>{{ $data['final_acceptance'] }}</td>--}}
{{--                                    <td>&#x20A6; {{ number_format(floatval($data['final_cost'])) }}</td>--}}
                                    <td>{{ $data['action_party'] }}</td>
                                    <td>{{ $data['champion'] }}</td>
                                    <td>
                                        @if(getUserRole() == 'admin')
                                            @if(!$data['approval_status'] == 1)
                                                <!-- <a href="{{ route('procurementPlan.edit', $data['id']) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a> -->
                                                <a href="#approvePlan{{ $data['id'] }}" data-toggle="modal" class="btn btn-success btn-sm">Approve submission</a>
                                                <a href="#declinePlan{{ $data['id'] }}" data-toggle="modal" class="btn btn-danger btn-sm">Reject submission</a>
                                            @else
                                                Approved
                                                <a href="#declinePlan{{ $data['id'] }}" data-toggle="modal" class="btn btn-warning btn-sm">Revert approval</a>
                                                <a href="{{ route('create-plan-advert', $data['id']) }}" class="btn btn-sm {{ $data['approval_status'] == 1 ? 'btn-success' : 'btn-primary'  }}"><i class="fa fa-eye"></i> Info</a>
                                            @endif
                                        @endif

                                        @if(getUserRole() == 'mda')
                                            @if(!$data['approval_status'] == 1)
                                                <a href="{{ route('create-plan-advert', $data['id']) }}" class="btn btn-sm {{ $data['approval_status'] == 1 ? 'btn-success' : 'btn-primary'  }}"><i class="fa fa-eye"></i> Info</a>
                                                <a href="{{ route('procurementPlan.edit', $data['id']) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a>
                                                <a href="{{ route('procurementPlan.delete', $data['id']) }}" class="btn btn-sm btn-danger">Delete</a>
                                            @else
                                                <a href="{{ route('create-plan-advert', $data['id']) }}" class="btn btn-sm {{ $data['approval_status'] == 1 ? 'btn-success' : 'btn-primary'  }}"><i class="fa fa-eye"></i> Info</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="6">{{' No Record Found '}}</td>
                        @endif
                        </tbody>
                    </table>
                </div>
                <!-- <button class="btn btn-danger btn-lg pull-right" style="padding-left: 10px;">Decline submission</button> -->

                <!-- <a href="#approvePlan" data-toggle="modal" class="btn btn-success btn-lg">Approve submission</a> -->
            </section>

            @foreach ($plans as $data)
                <div class="modal fade" id="approvePlan{{ $data['id'] }}">
                    <div class="modal-dialog">
                        <form class="bs-example form-horizontal" method="post"  action="{{ route('procurementPlan.approvePlan') }}">
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

                                    You are about to make a budget approval for <strong>{{ strtoupper($data['project_description']) }}</strong>?

                                    <input type="hidden" name="plan_ids[]" value="{{ $data['id'] }}">

                                    <input type="hidden" name="year" value="{{$year->id}}">
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
            @endforeach

            @foreach ($plans as $data)

                <div class="modal fade" id="declinePlan{{ $data['id'] }}">
                    <div class="modal-dialog">
                        <form class="bs-example form-horizontal" method="post"  action="{{ route('procurementPlan.approvePlan') }}">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Are you sure you want to decline?</h4>
                                </div>
                                <div class="modal-body">

                                    {{ csrf_field() }}
                                    <div class="alert alert-success d-none" id="mdas_div">
                                        <span id="mdas_message"></span>
                                    </div>

                                    You are about to decline budget approval for <strong>{{ strtoupper($data['project_description']) }}</strong>?
                                    <input type="hidden" name="plan_ids[]" value="{{ $data['id'] }}">
                                    <input type="hidden" name="plan_title" value="works">
                                    <input type="hidden" name="action_type" value="decline">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Yes... Decline</button>
                                </div>
                            </div>
                        </form>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            @endforeach

            <div class="modal fade" id="approvePlan">
                <div class="modal-dialog">
                    <form class="bs-example form-horizontal" method="post"  action="{{ route('procurementPlan.store') }}">
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

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Select Plan Type</label>
                                    <div class="col-lg-9">
                                        <select name="plan_type" required class="form-control">
                                            @foreach($plans as $plan)
                                                <option value="{{ strtolower($plan->title )}}">{{$plan->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Continue</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="viewdata">
                <div class="modal-dialog">
                    <form class="bs-example form-horizontal" method="post"  action="{{ route('procurementPlan.store') }}">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Select Plan</h4>
                            </div>
                            <div class="modal-body">

                                {{ csrf_field() }}
                                <div class="alert alert-success d-none" id="mdas_div">
                                    <span id="mdas_message"></span>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Select Plan Type</label>
                                    <div class="col-lg-9">
                                        <select name="plan_type" required class="form-control">
                                            @foreach($bizCat as $plan)
                                                <option value="{{ $plan->id }}">{{$plan->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Continue</button>
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

@endsection





