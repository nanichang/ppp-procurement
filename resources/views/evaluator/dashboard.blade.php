@extends('layouts.evaluator')

@section('evaluator')
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

            <section class="panel panel-info">
                <header class="panel-heading">
                    Advert Details
                </header>

                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        
                        <tbody>
                            <tr>
                                <td>Description</td>
                                <td>{{ $advertLot->description }}</td>
                            </tr>
                            <tr>
                                <td>Package No</td>
                                <td>{{ $advertLot->package_no }}</td>
                            </tr>
                            <tr>
                                <td>Lot No</td>
                                <td>{{ $advertLot->lot_no }}</td>
                            </tr>
                            
                            <tr>
                                <td>Tender Document</td>
                                <td>
                                    @if($advertLot->tender_document)
                                        <a href="{{ Storage::disk('s3')->url($advertLot->tender_document) }}" class="btn btn-s-md btn-primary btn-rounded"><i class="fa fa-file"></i> Tender Document</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Tender Document (In House)</td>
                                <td>
                                    @if($advertLot->tender_document_inhouse)
                                        <a href="{{ Storage::disk('s3')->url($advertLot->tender_document_inhouse) }}" class="btn btn-s-md btn-primary btn-rounded"><i class="fa fa-file"></i> In-House Tender Document</a> 
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>               
                </div>
            </section>
        </section>

    </section>
</section>

@endsection


