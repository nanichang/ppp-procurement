@extends('layouts.app')

@section('content')
<section class="hbox stretch">
  <section class="vbox">
      <section class="scrollable padder">
        <br/>
        @if($registration && !$registration->paid)
        <h3>
          Payment is required to access this page, Kindly pay the sum of {{ number_format($registration->amount, 2) }} or verify payment by clicking
          <a href="{{ route('contractor.registration.create') }}">here</a>
        </h3>
        @elseif($registration && $registration->paid)
        <section class="panel panel-info">
            <header class="panel-heading">
              Certificates
            </header>
            <input type="hidden" name="_token" id="_token" value="{{{ csrf_token() }}}" />
            <div class="table-responsive">
              <table class="table table-striped b-t b-light">
                <thead>
                  <tr>
                    <th data-toggle="class">Certification Type</th>
                    <th>Category Type</th>
                    <th>Date</th>
                    <th>Download</th>                          
                  </tr>
                </thead>
                <tbody> 
                  @if(sizeof($categories) > 0)
                    @foreach($categories as $data)
                    <tr>
                        <td>{{$data['registration_category']}}</td>
                        <td>{{$data['description']}}</td>
                        <td>{{$data['created_at']}}</td>           
                        <td><a href="{{action('ContractorController@downloadPDF', $data->id)}}">Download</a> </td>
                    </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan="4">{{'You have not Registered Under Any Categories'}}</td>
                      
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
        </section>
        @else
        <div class="alert alert-dark" role="alert">
          Nothing here yet! ;-)
        </div>
        @endif
      </section>
    </section>
  </section>
</section>
@endsection


