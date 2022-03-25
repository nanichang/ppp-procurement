@extends('layouts.evaluator')
@section('openbids')
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
                        <?php 
                            $image;
                            try {
                                $image = $contractors->user->profile_pic ? $contractors->user->profile_pic: 'images/noimage.png' ;
                            }
                            catch(Exception $ex){
                                $image = 'images/noimage.png';
                            }     
                        ?>
                        <div class="col-xs-6">
                            <img src="{{ url($image)}}" height="200"/>
                            <h4>{{ $contractors['company_name']}}</h4>
                            <address>
                                <?php try { ?>
                                    Email: {{$contractors['email']}}<br/>
                                    Website: {{$contractors['website']}}<br/>
                                    Address: {{$contractors['address']}}<br/>
                                    Telephone: {{ $contractors->user ? $contractors->user->phone : '' }}<br/>

                                <?php }catch (Exception $e) { ?>
                                    <!-- Email: {{$contractors['email']}}<br/>
                                    Website: {{$contractors['website']}}<br/>
                                    Address: {{$contractors['address']}}<br/> -->
                                <?php } ?>
                               
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                             <?php try { ?>
                                <p class="h4">Contractor IRR # {{  $contractors->user ? $contractors->user->registration_id : '' }}</p>
                                <h5>Date Registered: {{ $contractors['created_at']}}</h5>
                                <h5>Account Status: {{ $contractors['isActive'] == 0 ? 'Disabled' : 'Active'}}</h5>

                            <?php }catch (Exception $e) { ?>
                                <h5>Date Registered: {{ $contractors['created_at']}}</h5>
                                <h5>Account Status: {{ $contractors['isActive'] == 0 ? 'Disabled' : 'Active'}}</h5>
                            <?php } ?>
                            
                        </div>
                
                    </div>
                </div>
            </section>

            <section class="panel panel-default">
                <header class="panel-heading">
                    Board of Directors
                </header>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                        <th>S/N</th>
                        <th data-toggle="class">Full Name</th>
                        <th>Sex</th>
                        <th>Nationality</th>
                        <th>ID Type</th>
                        <th>ID No.</th>
                        <th>Membership</th>
                        <th>Membership ID</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  $i = 0; ?>
                    <?php //dd($directors); ?>
                    @if (sizeof($directors) < 1)
                        <tr>
                        <td colspan = '8'>No Records found</td>
                        </tr>
                    @else 
                        @foreach ($directors as $data)
                        <?php  $i++; ?>
                        <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $data['first_name'] }} {{ $data['last_name'] }}</td>
                        <td>{{ $data['gender'] }}</td>
                        <td>{{ $data['nationality'] }}</td>
                        <td>type</td>
                        <td>1</td>
                        <td>{{ $data['professional_membership'] }}</td>
                        <td>{{ $data['membership_id_no'] }}</td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                    </table>
                </div>
                </div>
            </section>

            <section class="panel panel-default">
                <header class="panel-heading">
                Staff/Personnel
                </header>
                <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-striped b-t b-light">
        <thead>
            <tr>
            <th>S/N</th>
            <th data-toggle="class">Full Name</th>
            <th>Gender</th>
            <th>Nationality</th>
            <th>Passport No.</th>
            <th>National ID</th>
            <th>Employee Type</th>
            <th>Joining Date</th>
            </tr>
        </thead>
        <tbody>
        @if (sizeof($personel) < 1)
            <tr>
            <td colspan = '8'>No Records found</td>
            </tr>
        @else 
            <?php  $j = 0; ?>

            @foreach ($personel as $data)
            <?php  $j++ ?>

            <tr>
            <td>{{$j}}</td>
            <td>{{ $data['first_name'] }} {{ $data['last_name'] }}</td>
            <td>{{ $data['gender'] }}</td>
            <td>{{ $data['nationality'] }}</td>
            <td>{{ $data['passport_no'] }}</td>
            <td>{{ $data['national_id_no'] }}</td>
            <td>{{ $data['employment_type'] }}</td>
            <td>{{ $data['joining_date'] }}</td>
            </tr>
            @endforeach
        @endif   
        </table>
            </div>
            </div>
        </section>


        <section class="panel panel-default">
            <header class="panel-heading">
            Business Category
            </header>
            <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-striped b-t b-light">
        <thead>
            <tr>
            <th>S/N</th>
            <th data-toggle="class">Business Category</th>
            <th>Business Sub-Category</th>
            <th>Business Sub-Category 2</th>
            </tr>
        </thead>
        <tbody>
        @if (sizeof($categories) < 1)
            <tr>
            <td colspan = '4'>No Records found</td>
            </tr>
        @else                         
            <?php  $k = 0; ?>

            @foreach ($categories as $data)
            <?php  $k++; ?>

            <tr>
            <td>{{$k }}</td>
            <td>{{$data['category']}}</td>
            <td>{{$data['subcategory_1']}}</td>
            <td>{{$data['subcategory_2']}}</td>
            </tr>
            @endforeach
        @endif 
        </tbody>
        </table>
        </div>
        </div>
    </section>


    <section class="panel panel-default">
        <header class="panel-heading">
        Projects Executed
        </header>
        <div class="panel-body">
        <div class="table-responsive">
        <table class="table table-striped b-t b-light">
        <thead>
            <tr>
            <th>S/N</th>
            <th data-toggle="class">Job Category</th>
            <th>Organization</th>
            <th>Job Title</th>
            <th>Job Description</th>
            <th>Contact Person</th>
            <th>Award Date</th>
            <th>Amount</th>
            </tr>
        </thead>
        <tbody>
        @if (sizeof($jobs) < 1)
            <tr>
            <td colspan = '8'>No Records found</td>
            </tr>
        @else 
        <?php  $l = 0; ?>

        @foreach ($jobs as $data)
             <?php  $l++; ?>

            <tr>
            <td>{{$l}}</td>
            <td>{{$data['job_category']}}</td>
            <td>{{$data['sub_category']}}</td>
            <td>{{$data['job_title']}}</td>
            <td>{{$data['job_description']}}</td>
            <td>{{$data['contact_phone']}}</td>
            <td>{{$data['award_date']}}</td>
            <td>{{number_format($data['amount'])}}</td>
            </tr>
        @endforeach
        @endif
        </tbody>
        </table>
        </div>
        </div>
    </section>


    <section class="panel panel-default">
        <header class="panel-heading">
        Financial Statements
        </header>
        <div class="panel-body">
        <div class="table-responsive">
        <table class="table table-striped b-t b-light">
        <thead>
            <tr>
            <th>S/N</th>
            <th data-toggle="class">Year</th>
            <th>Turn Over (N)</th>
            <th>Total Assets (N)</th>
            <th>Total Liability (N)</th>
            <th>Witholding Tax (N)</th>
            <th>Tax Paid (N)</th>
            <th>TCC No.</th>
            <th>Audit Firm</th>
            <th>Date</th>
            </tr>
        </thead>
        <tbody>
        @if (sizeof($financies) < 1)
            <tr>
            <td colspan = '10'>No Records found</td>
            </tr>
        @else 
        <?php  $m = 0; ?>

        @foreach ($financies as $data)
        <?php  $m++; ?>

            <tr>
            <td>{{$m}}</td>
            <td>{{$data['year']}}</td>
            <td>{{number_format($data['turn_over'])}}</td>
            <td>{{number_format($data['total_asset'])}}</td>
            <td>{{number_format($data['total_liability'])}}</td>
            <td>{{number_format($data['witholding_tax'])}}</td>
            <td>{{number_format($data['tax_paid'])}}</td>
            <td>{{$data['tcc_no']}}</td>
            <td>{{$data['audit_firm']}}</td>
            <td>{{$data['report_date']}}</td>
            </tr>
        @endforeach
        @endif
        </tbody>
        </table>
                </div>
                </div>
            </section>


            <section class="panel panel-default">
                <header class="panel-heading">
                 Machines/Equipments
                </header>
                <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-striped b-t b-light">
        <thead>
            <tr>
            <th>S/N</th>
            <th data-toggle="class">Equipment type</th>
            <th>Acquisition Date</th>
            <th>Cost (N)</th>
            <th>Location</th>
            <th>Serial No.</th>
            <th>Reg. No.</th>
            <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @if (sizeof($machineries) < 1)
            <tr>
                 <td colspan = '8'>No Records found</td>
            </tr>
        @else 
        <?php  $n = 0; ?>

        @foreach ($machineries as $data)
        <?php  $n++; ?>

            <tr>
            <td>{{$n}}</td>
            <td>{{$data['equipment_type']}}</td>
            <td>{{$data['acquisition_date']}}</td>
            <td>{{number_format($data['cost'])}}</td>
            <td>{{$data['location']}}</td>
            <td>{{$data['serial_no']}}</td>
            <td>{{$data['serial_no']}}</td>
            <td>{{$data['equipment_status']}}</td>
            
            </tr>
        @endforeach
        @endif
        </tbody>
        </table>
        </div>
        </div>
    </section>


            <section class="panel panel-default">
                <header class="panel-heading">
                Documents uploaded
                </header>
                <div class="panel-body">
                    <div class="row">
                        @if (sizeof($getUploadfiles) < 1)
                         <div class="col-md-6 text-center" style="padding: 8px;"><a href="#" class="btn btn-s-md btn-primary btn-rounded"><i class="fa fa-file"></i>No Uploads Found</a></div>
                        @else 
                        @foreach ($getUploadfiles as $data)
                            <div class="col-md-6 text-center" style="padding: 8px;"><a href="{{ Storage::disk('s3')->url('uploads/' . $data->key) }}" class="btn btn-s-md btn-primary btn-rounded"><i class="fa fa-file"></i>{{ ' '.strtoupper($data['name']) }}</a></div>
                        @endforeach
                        @endif  
                    </div>
                </div>
            </section>
        </section>
    </section>
</section>
@endsection
