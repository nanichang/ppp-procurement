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
                            @if(count($awards) > 0)
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
                                        @foreach($awards as $award)
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
                                                <a href="/contractor/awards/{{$award->id}}" class="btn btn-sm btn-success" > <i class="fa fa-trophy"></i> Award</a>
                                            </td>
                                        </tr>
                                        @endforeach                          
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <h1>There are no awards here yet</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

        </section>

    </section>
</section>

@endsection


