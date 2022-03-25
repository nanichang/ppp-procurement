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
                    Evaluation Results
                </header>

                <div class="panel panel-body">
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <h4>{{ $criteria->title}}</h4>
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
                                    @for($j = 0; $j < count($results[$criteria->id]); $j++)
                                        <tr>
                                            <td>{{$j + 1}}</td>
                                            <td><a href="{{ route('evaluatorContractorPreview',$results[$criteria->id][$j]->contractor_id) }}">{{ $results[$criteria->id][$j]->contractor }}</a></td>
                                            <td>{{ $results[$criteria->id][$j]['score'] }}</td>
                                        </tr>
                                    @endfor                               
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </section>

    </section>
</section>

@endsection


