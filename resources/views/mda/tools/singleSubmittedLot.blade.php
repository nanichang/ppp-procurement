@extends(getUserRole() == 'mda' ? 'layouts.mda' : 'layouts.admin')

@section('evaluator')
    active
@endsection
@section('content')

<style>
    p {
	position: relative;
	max-width: 30em;
	background-color: #fff;
	padding: 1.125em 1.5em;
	font-size: 1.25em;
	border-radius: 1rem;
    box-shadow:	0 0.125rem 0.5rem rgba(0, 0, 0, .3), 0 0.0625rem 0.125rem rgba(0, 0, 0, .2);
}

p::before {
	content: '';
	position: absolute;
	width: 0;
	height: 0;
	bottom: 100%;
	left: 1.5em; // offset should move with padding of parent
	border: .75rem solid transparent;
	border-top: none;
	border-bottom-color: #fff;
	filter: drop-shadow(0 -0.0625rem 0.0625rem rgba(0, 0, 0, .1));
}
</style>

<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
          <br/>

            <section class="panel panel-info">
                <header class="panel-heading">
                    <div style="float: left;">Bid: {{ $sale->advert_name}}</div>
                    <div style="float: right;">
                    @if($sale->is_awarded == 1)
                    <!-- <a href="#commentModal" data-toggle="modal" class="btn btn-danger btn-sm pull-right" style="margin-left: 5px;"> Undo Contract award</a> -->
                    <!-- <i style="font-size: 1.8em;color: blue;" class="fa fa-trophy"></i> -->
                    @else 
                    <!-- <a href="#commentModal" data-toggle="modal" class="btn btn-success btn-sm pull-right" style="margin-left: 5px;"> Award Contract to this contractor</a> -->
                    @endif
                    </div>
                    <div style="clear: both;"></div>
                </header>
                
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        
                        <tbody>
                            <tr>
                                <td>Description</td>
                                <td>{{ $sale->lot_description }}</td>
                            </tr>
                        </tbody>
                    </table>               
                </div>
            </section>

            <section class="panel panel-info">
                <header class="panel-heading">
                    Contractor
                </header>

                <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        
                    </thead>
                    <tbody>
                        <tr>
                            <td>Project</td>
                            <td>{{$sale->lot_description}}</td>
                            
                        </tr>
                        <tr>
                            <td>MDA Name</td>
                            <td>{{$sale->mda_name}}</td>
                        </tr>
                        <tr>
                            <td>Contractor</td>
                            <td>{{$sale->contractor_name}} ( {{ $sale->contractor->email }} )</td>                            
                        </tr>
                        
                        <tr>
                            <td>Category</td>
                            <td>{{ $sale->advertLot->category_name }}</td>
                        </tr>
                        <tr>
                            <td>
                                Lot amount
                            </td>
                            <td>
                                {{ $sale->advertLot->lot_amount }}
                            </td>
                        </tr>
                        <tr>
                            <td>Tender Document</td>
                            <td>
                                @if($sale->advertLot->tender_document)
                                    <a href="{{ Storage::disk('s3')->url($sale->advertLot->tender_document) }}" class="btn btn-s-md btn-primary btn-rounded"><i class="fa fa-file"></i>Tender Document</a>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td>
                                In-House Bid Amount
                            </td>
                            <td>
                                {{ $sale->advertLot->inhouse_bid_amount }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Bid Amount
                            </td>
                            <td>
                                {{ $sale->contractor_bid_amount }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Variation
                            </td>
                            <td>
                                {{ $sale->variation }}
                            </td>
                        </tr>
                    </tbody>
                </table>    
                </div>
            </section>

            @if(count($sale->evaluatorLotEvaluations) > 0)
            @foreach($evs as $evaluatorLotEvaluations)
            <section class="panel panel-default">
                <div class="panel-body">
                <h2>{{$loop->index + 1}} - {{$evaluatorLotEvaluations[0]->evaluator_name}}</h2>
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
                            @foreach($evaluatorLotEvaluations as $item)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{ strtoupper($item->advertCriteria->title) }}</td>
                                    <td>{{ strtoupper($item->advertCriteria->description) }}</td>
                                    <td>
                                        @if($item->type == "binary")
                                            @if($item->binary_value)
                                                YES
                                            @else
                                                NO
                                            @endif
                                        @else
                                            {{ $item->numeric_value }}
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                            @endforeach                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </section> 
            @endforeach
            @endif
            
            <section class="panel panel-warning">
                <header class="panel-heading">
                    Evaluator's Comments
                </header>

                <div class="panel panel-body">
                    @if(sizeof($comments) > 0)
                        @foreach($comments as $comment) 
                            <p> <strong>{{ ucwords($comment->evaluator_name) }}</strong>:  {{ $comment->comment }}</p>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">NO COMMENTS FOUND</td>
                        </tr>
                    @endif
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
                            <form class="bs-example form-horizontal" method="post">
                                {{ csrf_field() }}
                                <div class="alert alert-success d-none" id="mdas_div">
                                    <span id="mdas_message"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Comment</label>
                                    <div class="col-lg-12">
                                        <textarea name="report" id="report" rows="5" class="form-control"></textarea>
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
        </section>

    </section>
</section>

@endsection


