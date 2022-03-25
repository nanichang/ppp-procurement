@extends('layouts.admin')
@section('reports')
active
@endsection

@section('content')
<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
            <br/>
            <section class="panel panel-info">
                <header class="panel-heading">
                    Contractors
                </header>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>CAC RC No.</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <!-- <th>TCC No.</th>
                                <th>ITF ID</th> -->
                                <th>Is Active</th>
                                <th>Preview</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  $i = 0; ?>
                            @if(sizeof($contractors) > 0)
                                @foreach ($contractors as $data)
                                    <tr>
                                        <td>{{ $data->user->name }}</td>
                                        <td>{{ $data->user->cac }}</td>
                                        <td>{{ $data->user->email }}</td>
                                        <td>{{ $data->user->phone }}</td>
                                        <!-- <td>{{ $data->tcc_no }}</td>
                                        <td>{{ $data->itf_registration_no }}</td> -->
                                        <td>{{ $data->isActive === 1 ? 'Active' : 'In-active' }}</td>
                                        <td>
                                            <a href="{{ route('contractorPreview',$data->user->id) }}" class="active"><i class="fa fa-search text-success text-active"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan = '8'>{{ 'No Record Found'}}</td>                                    
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </section>
        </section>
    </section>
</section>
@endsection
