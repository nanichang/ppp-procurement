@extends('layouts.auth')

@section('content')
    <div class="col-md-12  padding-0 margin-0 row">
        <div class="col-md-5 flex-center padding vh100">
            <div class="col-md-8">
                <a class="navbar-brand padding-0 block" href="">e-Procurement Portal</a>
                <section class="m-b-lg padding-0">
                    <header class="wrapper text-center">
                        <img height="150" src="{{ url('images/logo.png') }}" />
                    </header>
                    <form method="POST" action="{{ route('evaluator_login') }}">
                        @csrf
                        <div class="list-group">
                            <div class="list-group-item">
                                <input type="email" value="{{ $email }}"  class="form-control no-border" disabled>
                                <input type="hidden" name="email" value="{{ $email }}"  class="form-control no-border">
                                <input type="hidden" name="id" value="{{ $id }}" class="form-control no-border">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="list-group-item">
                                <input type="text" name="code" placeholder="Enter your code" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} no-border">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @if(session('error'))
                                <div class="alert alert-danger" role="alert">
                                    <p>{{ session('error') }}</p>
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="alert alert-danger" role="alert">
                                    <p>{{ session('success') }}</p>
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary btn-block">Sign in</button>
                    </form>          
                    <footer class="m-t-lg" id="footer">
                        <div class="text-center padder">
                            <p>
                                <small>Powered by PICTDA<br>&copy; {{ date('Y') }}</small>
                            </p>
                        </div>
                    </footer>          
                </section>
            </div>
        </div>
        <div class="col-md-7 position-relative padding-0  vh100">
            <img src="<?php echo e(asset('images/wallpaper.png')); ?>" />
            <div class="content flex-center w-100">
                <div class="col-md-7">
                    <h2>Plateau State BPP</h2>
                    <p>The wind of change in public procurement that guarantees transparency, accountability, competition and cost effectiveness was imbibed by the Plateau State Government.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
