@extends('layouts.evaluator')
@section('openbids')
    active
@endsection
@section('content')

<style>
    p {
	// layout
	position: relative;
	max-width: 30em;
	
	// looks
	background-color: #fff;
	padding: 1.125em 1.5em;
	font-size: 1.25em;
	border-radius: 1rem;
  box-shadow:	0 0.125rem 0.5rem rgba(0, 0, 0, .3), 0 0.0625rem 0.125rem rgba(0, 0, 0, .2);
}

p::before {
	// layout
	content: '';
	position: absolute;
	width: 0;
	height: 0;
	bottom: 100%;
	left: 1.5em; // offset should move with padding of parent
	border: .75rem solid transparent;
	border-top: none;

	// looks
	border-bottom-color: #fff;
	filter: drop-shadow(0 -0.0625rem 0.0625rem rgba(0, 0, 0, .1));
}
</style>

<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
          <br/>
            <section class="panel panel-default">
                <header class="panel-heading">
                    Interested Contractors
                    @if($evaluator->user_type == 'user')
                    @if(!$awarded)
                    <a href="#commentModal" data-toggle="modal" class="btn btn-s-md btn-primary btn-rounded" style="float: right;"><i class="fa fa-plus"></i> Make Comment</a>
                    @endif
                    @else
                    <a href="/evaluator-dashboard/results" class="btn btn-s-md btn-primary btn-rounded" style="float: right;"><i class="fa fa-bar-chart"></i> Evaluation Result</a>
                    @endif
                </header>
                <div class="panel-body">
                @foreach($sales as $sale)
                    <h2>{{$loop->index + 1}} - {{$sale->contractor_name}} 
                    @if(true)
                        <i class="i i-circle-sm text-success-dk"></i>
                    @else
                        <i class="i i-circle-sm text-danger-dk"></i>
                    @endif</h2>
                    <table class="table" style="width: auto;">
                        <tr>
                            <td>
                                @if($sale->contractor_tender_document)
                                    <a href="{{ Storage::disk('s3')->url($sale->contractor_tender_document) }}" class="btn btn-s-md btn-success btn-rounded"><i class="fa fa-file"></i> Tender Document</a>
                                @endif
                            </td>
                            <td>
                                @if($sale->contractor_tender_document)
                                    <a href="{{ route('evaluatorContractorPreview', $sale->contractor_id) }}" class="btn btn-primary btn-sm"><i class="fa fa-info"></i> Contractor Info</a>
                                @endif
                            </td>
                            <td>
                                @if($evaluator->user_type == 'user')
                                @if(!$awarded)
                                <a href="#" data-id="{{ $sale->advert_lot_id }}" data-sale-id="{{ $sale->id }}" data-contractor-id="{{ $sale->contractor_id }}" data-name="{{$sale->contractor_name}}" class="btn btn-sm btn-primary showContractorCriteriaModal">
                                    <i class="fa fa-file"></i> Evaluate Requirement
                                </a>
                                @endif
                                @else
                                <a href="/evaluator-dashboard/results-contractor/{{$sale->contractor_id}}" class="btn btn-s-md btn-primary btn-rounded" style="float: right;"><i class="fa fa-bar-chart"></i> Result</a>
                                @endif
                            </td>
                        </tr>    
                    </table>
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr>
                                    <th>Contractor</th>
                                    <th data-toggle="class">Tender Fee</th>
                                    <th>Inhouse Estimate</th>
                                    <th>Contractor Submission</th>
                                    <th>Difference</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$sale->contractor_name}}</td>
                                    <td>{{ number_format($sale->amount, 2) }}</td>
                                    <td>{{ number_format($sale->advertLot->inhouse_bid_amount, 2) }}</td>
                                    <td>{{ number_format($sale->contractor_bid_amount, 2) }}</td>
                                    <td>{{ number_format($sale->variation, 2) }}</td>
                                </tr>
                                
                            </tbody>
                        </table>    
                    </div>
                    <hr/>
                    @if(count($sale->evaluatorLotEvaluations) > 0)

                    @php
                    $evaluatorLotEvaluations = $sale->evaluatorLotEvaluations->groupBy('evaluator_id');
                    @endphp

                    @foreach($evaluatorLotEvaluations as $evaluatorId => $evs)
                    <h4>Evaluation by {{ $evs[0]->evaluator_name}}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr>
                                    <th>SN</th> 
                                    <th>Item</th>                                    
                                    <th>Description</th>
                                    <th>Value</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($evs as $item)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{ $item->advertCriteria->title }}</td>
                                    <td>{{ $item->advertCriteria->description }}</td>
                                    <td>
                                        @if($item['type'] == "binary")
                                            @if($item->binary_value)
                                                YES
                                            @else
                                                NO
                                            @endif
                                        @else
                                            {{ $item['numeric_value'] }}
                                        @endif
                                    </td>
                                    <td>{{ $item['created_at'] }}</td>
                                </tr>
                            @endforeach                                
                            </tbody>
                        </table>
                    </div>
                    @endforeach
                    @endif
                @endforeach
                </div>
            </section>

            <div class="modal fade" id="commentModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Post a Comment to this Lot</h4>
                        </div>
                        <div class="modal-body">
                            <form class="bs-example form-horizontal" method="post" action="{{ route('evaluator.postcomment') }}">
                                {{ csrf_field() }}
                                <div class="alert alert-success d-none" id="mdas_div">
                                    <span id="mdas_message"></span>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Comment</label>
                                    <div class="col-lg-9">
                                        <textarea name="comment" id="comment" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-send"></i> Post Comment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
                            
                            <form class="bs-example form-horizontal" action="{{ route('evaluator.contractor') }}"  method="post" enctype="multipart/form-data">
                                
                                <div class="alert alert-warning show">
                                    <strong>Give Assessments</strong> based on pre-configured criteria. All parameters is between 0 - 100.
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped b-t b-light">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Required</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody id="contactorAdscriteria">
                                            @if(sizeof($advertCriterias) > 0)
                                                @foreach($advertCriterias as $ac)
                                                    <tr>
                                                        <td>{{ ucfirst($ac->title) }}</td>
                                                        <td>{{$ac->required ? "YES" : "NO"}}</td>
                                                        <td>
                                                            @if($ac->value_type == "numeric")
                                                            <input type="number" name="criterias[]" />
                                                            @else
                                                            <select name="criterias[]">
                                                                <option>No</option>
                                                                <option>Yes</option>
                                                            </select>
                                                            @endif
                                                        </td>
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
                                <input type="hidden" name="advert_lot_id" id="advert_lot_id">
                                <input type="hidden" name="contractor_id" id="contractor_id">
                                <input type="hidden" name="sale_id" id="sale_id">

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
</section>

<script>

    window.addEventListener('load', function () {
        $(".showContractorCriteriaModal").on('click', function(evt){
            evt.preventDefault();
            var currentId = $(this).attr('data-id');
            var contractorId = $(this).attr('data-contractor-id');
            var saleId = $(this).attr('data-sale-id');
            var name = $(this).attr('data-name');
            $('#headerTitle').html(' '+name);
            $('#advert_lot_id').val(currentId);
            $('#contractor_id').val(contractorId);
            $('#sale_id').val(saleId);
            if(!currentId){
                console.log("Bug");
                return;
            }
            $(".contractorCriteriaModal").modal('show');
        });
    });

</script>

@endsection


