@extends('layouts.admin')
@section('getmdas')
active
@endsection

@section('content')
<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
            <br/>
            <section class="panel panel-default">
                <div class="panel-body">
                <div class="row">
                
                    <div class="col-xs-6">
                        <!-- <img src="{{ asset('/images/p0.jpg') }}" height="200"/> -->
                        
                        <?php  $image = $mdas->profile_pic ? $mdas->profile_pic: 'images/download.png' ?>

                        <img src="{{url($image)}}" height="200"/>
                        <h4></h4>
                        <address>
                            Email: {{ $mdas->email }}<br/>
                            Address: {{ $mdas->address }}<br/>
                        </address>
                    </div>
                    <div class="col-xs-6 text-right">
                        <p class="h4">MDA code #{{ strtoupper($mdas->mda_code) }} </p>
                        <h5>MDA Shortcode: {{ $mdas->mda_shortcode }}</h5>
                    </div>
             
                </div>
                </div>
            </section>

            <section class="panel panel-default">
                <header class="panel-heading">
                    <a href="{{ route('viewSubmittedPlans', $mdas->id) }}" class="btn btn-success">View submissions</a>
                </header>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Mandate</th>
                                <th>Bank Name</th>
                                <th>Bank Account</th>
                                <th>Split Percentage</th>
                                <!-- <th>Membership</th>
                                <th>Membership ID</th> -->
                                </tr>
                            </thead>
                            <tbody>
                            <?php  $i = 0; ?>
                            
                                <tr>
                                <td>{{ $mdas->name }}</td>
                                <td>{{ $mdas->subsector }}</td>
                                <td>{{ $mdas->mandate }}</td>
                                <td>{{ $mdas->bank_name }}</td>
                                <td>{{ $mdas->bank_account }}</td>
                                <td>{{ $mdas->split_percentage }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </section>
    </section>
</section>
@endsection
