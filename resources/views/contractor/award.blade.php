@extends('layouts.app')
@section('awards')
active
@endsection
@section('content')
<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
          <br/>

            <section class="panel">
                <header class="panel-heading">
                    Award
                </header>

                <div class="panel panel-body">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <h4>{{$award->planAdvert->name}}</h4>
                            <div class="table-responsive" style="margin-bottom: 20px;">
                                <table class="table table-striped b-t b-light">
                                    <thead>
                                        <tr>
                                            <th>Advert</th>
                                            <th>Lot</th>
                                            <th>Contractor</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $award->planAdvert->name }}</td>
                                            <td>{{  $award->advertLot->package_no . "/". $award->advertLot->lot_no }}</td>
                                            <td>{{ $award->contractor->company_name }}</td>
                                            <td>{{ strtoupper($award->status) }}</td>
                                            <td>
                                                @if($award->acceptance_comment)
                                                {{ $award->acceptance_comment }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($award->status == 'awarded' || $award->status == 'accepted')
                                                <a class="btn btn-primary" href="{{route('downloadAwardPdf', $award->id)}}">Download Award</a>
                                                @endif
                                            </td>
                                        </tr>                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($award->status == 'awarded')
                    <div class="container">
                        <h1 class="success">Accept Award</h1>
                        <form class="bs-example form-horizontal" action="{{route('acceptAward', $award->id)}}"  method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="acceptance_comment">Acceptance Comment</label>
                                <textarea id="acceptance_comment" class="form-control" name="acceptance_comment"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="uploaded_acceptance_file">Upload Acceptance Letter</label>
                                <input type="file" id="uploaded_acceptance_file" name="uploaded_acceptance_file" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit"  class="btn btn-sm btn-success"><i class="fa fa-gear"></i> Accept award</button>
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </section>

        </section>

    </section>
</section>

@endsection


