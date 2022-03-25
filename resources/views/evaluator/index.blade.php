@extends(getUserRole() == 'mda' ? 'layouts.mda' : 'layouts.admin')
@section('advertlists')
active
@endsection
@section('content')
    <section class="hbox stretch">
        <section class="vbox">
            <section class="scrollable padder">
                <br/>

                <section class="panel panel-info">
                    <header class="panel-heading">
                    Evaluator's Lists - {{ $lot->description }}
                    </header>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach()
                        </div>
                    @endif
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p><b>{{ $message }}</b></p>
                        </div>
                    @endif
                
                    <div class="row wrapper">
                        <div class="col-sm-9 m-b-xs">
                            @php 
                            $cnt = 0;
                            foreach($lot->awards as $award){
                                if($award->status == 'awarded' || $award->status == 'accepted'){
                                    $cnt++;
                                }
                            }
                            @endphp
                            @if($cnt == 0)
                            <a href="#addNewEvaluator" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Invite an Evaluator</a> 
                            @endif                   
                            <a href="{{url('/mda/procurement/plan-adverts/'.$lot->plan_advert_id.'/preview')}}" class="btn btn-sm btn-primary"><i class="fa fa-gear"></i> Return back</a>                    
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped b-t b-light">
                            <thead>
                                <tr>

                                    <th width="20"></th>
                                    <th>Name of evaluator</th>
                                    <th>Email</th>
                                    <th data-toggle="class">Account Type</th>
                                    <th data-toggle="class">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @if(sizeof($evaluators) > 0)
                                    @foreach($evaluators as $ev)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$ev->name}}</td>
                                            <td>{{$ev->email}}</td>
                                            <td>{{ $ev->user_type }}</td>
                                            <td>
                                                <a href="{{ route('evaluator.resend', $ev->code) }}" class="btn btn-primary btn-sm">Resend Invite</a>
                                                <a href="{{ route('evaluator.delete', $ev->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">NO RECORD FOUND</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="modal fade" id="addNewEvaluator">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Invite an Evaluator</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="bs-example form-horizontal" method="post">
                                        {{ csrf_field() }}
                                        <div class="alert alert-success d-none" id="mdas_div">
                                            <span id="mdas_message"></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Name of Evaluator</label>
                                            <div class="col-lg-9">
                                                <input type="text" name="name" required class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Email of Evaluator</label>
                                            <div class="col-lg-9">
                                                <input type="email" name="email" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Evaluator Type</label>
                                            <div class="col-lg-9">
                                                <select name="user_type" class="form-control">
                                                    <option value="user">User</option>
                                                    <option value="mda">MDA Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="advert_lot_id" value="{{ $lot->id }} ">
                                        <input type="hidden" name="plan_advert_id" value="{{ $lot->plan_advert_id }} ">

                                        @if(Auth::user()->user_type == 'mda')
                                            <input type="hidden" name="mda" value="{{ Auth::user()->email }}">

                                        @else                                
                                            <div class="form-group">
                                                <label class="col-lg-3 control-label">Select MDA</label>
                                                <div class="col-lg-9">
                                                    <select name="mda" id="" class="form-control">
                                                        @foreach($mdas as $mda)
                                                            <option value="{{ $mda->id }}">{{ $mda->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-send"></i> Send Invite</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </section>
    </section>

@endsection
