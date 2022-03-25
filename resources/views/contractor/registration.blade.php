@extends('layouts.app')
@section('registration')
    active
@endsection
@section('content')
    <section class="hbox stretch">
        <section class="vbox">
            <section class="scrollable padder">
            <div class="row">
            <section class="panel panel-default">
                <header class="panel-heading bg-light">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active"><a href="#Company" data-toggle="tab"><i class="fa fa-bars"></i> Company</a></li>
                        <li><a href="#Compliance" data-toggle="tab"><i class="fa fa-bars"></i> Compliance</a></li>
                        <li><a href="#Directors" data-toggle="tab"><i class="fa fa-bars"></i> Directors</a></li>
                        <li><a href="#Category" data-toggle="tab"><i class="fa fa-bars"></i> Category</a></li>
                        <li><a href="#Personnel" data-toggle="tab"><i class="fa fa-group"></i> Personnel</a></li>
                        <li><a href="#JobsDone" data-toggle="tab"><i class="fa fa-bars"></i> Jobs</a></li>
                        <li><a href="#Finance" data-toggle="tab"><i class="fa fa-bars"></i> Finance</a></li>
                        <li><a href="#Machinery" data-toggle="tab"><i class="fa fa-bars"></i> Machinery</a></li>
                        <li><a href="#Uploads" data-toggle="tab"><i class="fa fa-file"></i> Uploads</a></li>
                    </ul>
                </header>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="Company">@include('contractor/partials/Company')</div>
                        <div class="tab-pane" id="Compliance">@include('contractor/partials/Compliance')</div>
                        <div class="tab-pane" id="Directors">@include('contractor/partials/Directors')</div>
                        <div class="tab-pane" id="Category">@include('contractor/partials/Category')</div>
                        <div class="tab-pane" id="Personnel">@include('contractor/partials/Personnel')</div>
                        <div class="tab-pane" id="JobsDone">@include('contractor/partials/JobsDone')</div>
                        <div class="tab-pane" id="Finance">@include('contractor/partials/Finance')</div>
                        <div class="tab-pane" id="Machinery">@include('contractor/partials/Machinery')</div>
                        <div class="tab-pane" id="Uploads">@include('contractor/partials/Uploads')</div>
                    </div>
                </div>
            </section>
            </div>
            </section>
        </section>
    </section>
@endsection
