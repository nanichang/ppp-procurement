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

            <section class="panel">
                <header class="panel-heading">
                    Evaluation Results for {{$contractor->name}}
                </header>

                <div class="panel panel-body">
                    <div class="row">
                        @for($i = 0; $i < count($advertCriterias); $i++)
                        <div class="col-6 col-md-6">
                            <h4>{{ $advertCriterias[$i]->title}}</h4>
                            <div class="table-responsive" style="margin-bottom: 20px;">
                                <table class="table table-striped b-t b-light">
                                    <thead>
                                        <tr>
                                            <th>S/N</th> 
                                            <th>Contractor</th>
                                            <th>Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @for($j = 0; $j < count($results[$advertCriterias[$i]->id]); $j++)
                                        <tr>
                                            <td>{{$j + 1}}</td>
                                            <td><a href="{{ route('evaluatorContractorPreview',$results[$advertCriterias[$i]->id][$j]->contractor_id) }}">{{ $results[$advertCriterias[$i]->id][$j]->contractor }}</a></td>
                                            <td>{{ $results[$advertCriterias[$i]->id][$j]['score'] }}</td>
                                        </tr>
                                    @endfor                               
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endfor
                    </div>
                    @if($activeAward == null)
                    <div class="row">
                        <a href="#awardModal" data-toggle="modal" class="btn btn-success btn-sm pull-right" style="margin-left: 5px;"> Award Contract to this contractor</a>
                    </div>
                    @endif
                </div>
            </section>

            <div class="modal fade" id="awardModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Get Approval to Award this Contract</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('createAward')}}" class="bs-example form-horizontal" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="control-label">Comment</label>
                                    <div class="col-lg-12">
                                        <textarea name="comment" id="report" rows="5" class="form-control"></textarea>
                                        <input type="hidden" name="sales_id" value="{{$sales->id}}"/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-send"></i> Get Approval</button>
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


