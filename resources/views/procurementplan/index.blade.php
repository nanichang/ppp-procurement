
@extends('layouts.admin')

@section('procurement-plan')
    active
@endsection

@section('content')
<section class="hbox stretch">
    <section class="vbox">
        <section class="scrollable padder">
            <br/>
            <section class="panel panel-info">
                <header class="panel-heading">
                    Procurement Plan
                </header>

                <form class="bs-example form-horizontal" id="deleteMdas" action="javascript:void(0)" Method="POST">

                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th width="20">
                                    <label class="checkbox m-l m-t-none m-b-none i-checks">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th data-toggle="class">Year</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="mdas">
                        <?php  $i = 0; ?>
                        @if(sizeof($years) > 0)
                            @foreach ($years as $data)
                                <tr>
                                    <td>
                                        <label class="checkbox m-l m-t-none m-b-none i-checks">
                                            <input type="checkbox" name="mda[]" value="{{ $data['id']}}"><i></i></label>
                                    </td>
                                    <td>{{ $data['year'] }}</td>
                                    <td>{{ ($data['active'] == 1 ? 'Is Active' : 'Not Active') }}</td>

                                    <td>
                                        @if($data['active'] == 1)
                                            <a data-toggle="modal" disabled="disable" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Active</a>
                                            <a href="{{ route('procurementPlan.viewall', $data['id']    ) }}" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View Submissions</a>
                                        @else
                                            <button class="btn btn-sm btn-danger" disabled>Not Active</button>
                                            <!-- <a href="{{ route('procurementPlan.viewall', $data['id']) }}" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View Submissions</a> -->
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="6">{{' No Record Found '}}</td>
                        @endif
                        </tbody>
                    </table>
                    {{ $years->links() }}
                </div>
            </form>
            </section>

            <div class="modal fade" id="addNewMDA">
                <div class="modal-dialog">
                    <form class="bs-example form-horizontal" method="post"  action="{{ route('procurementPlan.store') }}">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add New Plan</h4>
                            </div>
                            <div class="modal-body">

                                {{ csrf_field() }}
                                <div class="alert alert-success d-none" id="mdas_div">
                                    <span id="mdas_message"></span>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Select Plan Type</label>
                                    <div class="col-lg-9">
                                        <select name="plan_type" required class="form-control">
                                            @foreach($plans as $plan)
                                                <option value="{{ $plan->id }}">{{$plan->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Continue</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="viewdata">
                <div class="modal-dialog">
                    <form class="bs-example form-horizontal" method="post"  action="{{ route('procurementPlan.viewall') }}">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Select Plan</h4>
                            </div>
                            <div class="modal-body">

                                {{ csrf_field() }}
                                <div class="alert alert-success d-none" id="mdas_div">
                                    <span id="mdas_message"></span>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Select Plan Type</label>
                                    <div class="col-lg-9">
                                        <select name="plan_type" required class="form-control">
                                            @foreach($plans as $plan)
                                                <option value="{{ $plan->id }}">{{$plan->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Continue</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </section>
    </section>
</section>

@endsection





