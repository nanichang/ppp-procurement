@extends('layouts.evaluator')
@section('awards')
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

            <section class="panel">
                <header class="panel-heading">
                    Awards
                </header>
                @if($evaluator->user_type == "mda")
                <div class="panel panel-body">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            @if(count($awards) > 0)
                            <h4>{{$awards[0]->planAdvert->name}}</h4>
                            @endif
                            <div class="table-responsive" style="margin-bottom: 20px;">
                                <table class="table table-striped b-t b-light">
                                    <thead>
                                        <tr>
                                            <th>Advert</th>
                                            <th>Lot</th>
                                            <th>Contractor</th>
                                            <th>Status</th>
                                            <th>Comments</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($awards as $award)
                                        <tr>
                                            <td>{{ $award->planAdvert->name }}</td>
                                            <td>{{  $award->advertLot->package_no . "/". $award->advertLot->lot_no }}</td>
                                            <td>{{ $award->contractor->company_name }}</td>
                                            <td>{{ strtoupper($award->status) }}</td>
                                            <td>
                                                @if($award->comment)
                                                {{ $award->comment }} <br/>
                                                @endif
                                                @if($award->approval_comment)
                                                {{ $award->approval_comment }} <br/>
                                                @endif
                                                @if($award->acceptance_comment)
                                                {{ $award->acceptance_comment }} <br/>
                                                @endif
                                                @if($award->cancellation_comment)
                                                {{ $award->cancellation_comment }} <br/>
                                                @endif
                                            </td>
                                            <td>
                                                @if($award->status == 'awarded' || $award->status == 'accepted')
                                                <a class="btn btn-primary" href="{{route('downloadAwardPdf', $award->id)}}">Download Award</a>
                                                @endif
                                                @if($award->status == 'accepted' && $award->uploaded_acceptance_file)
                                                <a href="{{ Storage::disk('s3')->url($award->uploaded_acceptance_file ) }}" class="btn btn-sm btn-default" >Acceptance Letter</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach                               
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($approvedAward)
                    <div class="container">
                        <form class="bs-example form-horizontal" action="{{route('uploadAwardLetter', $approvedAward->id)}}"  method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <button type="submit"  class="btn btn-sm btn-success"><i class="fa fa-gear"></i> Generate Award Letter</button>
                            </div>
                        </form>
                    </div>
                    @endif
                    @if($awardedAward)
                    <div class="container">
                        @if($awardedAward->award_notification_sent)
                        <h1 class="success">Award notification sent to contractor.</h1>
                        @endif
                        <form class="bs-example form-horizontal" action="{{route('awardNotification', $awardedAward->id)}}"  method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="award_letter_comment">Notification Text</label>
                                <textarea id="award_letter_comment" class="form-control" name="award_letter_comment"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit"  class="btn btn-sm btn-success"><i class="fa fa-gear"></i> Send Award Notification</button>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
                @else
                <h3>Sorry, you don't have the permission to view Awards.</h3>
                @endif
            </section>

        </section>

    </section>
</section>

@endsection


