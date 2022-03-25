@extends('layouts.evaluator')

@section('comments')
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

            <section class="panel panel-warning">
                <header class="panel-heading">
                    Evaluator's Comments
                </header>

                <div class="panel panel-body">
                   @foreach($comments as $comment) 
                        <p> <strong>{{ ucwords($comment->evaluator_name) }}</strong>:  {{ $comment->comment }}</p>
                   @endforeach
                </div>
            </section>

        </section>

    </section>
</section>

@endsection


