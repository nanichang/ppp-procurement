@extends('layouts.app')
@section('biddingdocuments')
active
@endsection
@section('content')
<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">

            <br/>

            <section class="panel panel-default">
                <header class="panel-heading">
                Documents uploaded
                </header>
                <div class="panel-body">
                    <div class="row">
                    @if (sizeof($documents) < 1)
                    <div class="col-md-6 text-center" style="padding: 8px;">No Uploads Found</div>
                    @else

                    @foreach ($documents as $document)

                        <div class="col-md-6 text-center" style="padding: 8px;"><a href="{{ Storage::disk('s3')->url('uploads/' . $document->key) }}" class="btn btn-s-md btn-primary btn-rounded"><i class="fa fa-file"></i>{{' '.strtoupper($document['name']) }}</a></div>
                    @endforeach
                    @endif
                    </div>
                </div>
            </section>


        </section>
    </section>
</section>
@endsection



