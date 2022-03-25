@extends('layouts.auth')

@section('content')


    <div class="col-md-12  padding-0 margin-0 row">
        <div class="col-md-7 position-relative padding-0 bg-right vh100">
            <img src="<?php echo e(asset('images/wallpaper.png')); ?>" />
            <div class="content flex-center w-100">
                <div class="col-md-7">
                    <h2>E-Procurement Portal</h2>
                    <p>A Law that seeks to bring a reverse in Public procurement process was considered by the Plateau State House of assembly.</p>
                </div>
            </div>
        </div>
        <div class="col-md-5 vh100 overflow-auto padding vh100">
            <a class="navbar-brand block" href="#">e-Procurement Portal</a>
            <section class="m-b-lg">
                <header class="wrapper text-center">
                    <img height="150" src="{{ asset('images/logo.png') }}"/>
                </header>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="list-group">
                        <div class="list-group-item">
                            <input type="name" name="name" value="{{ old('name') }}" required autofocus
                                   placeholder="Registered Business Name"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} no-border">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                            @endif
                        </div>
                        <div class="list-group-item">
                            <input type="name" name="cac" value="{{ old('cac') }}" required autofocus
                                   placeholder="CAC RC Number"
                                   class="form-control{{ $errors->has('cac') ? ' is-invalid' : '' }} no-border">
                            @if ($errors->has('cac'))
                                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('cac') }}</strong>
                </span>
                            @endif
                        </div>
                        <div class="list-group-item">
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                   placeholder="{{ __('E-Mail Address') }}"
                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} no-border">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                            @endif
                        </div>
                        <div class="list-group-item">
                            <input type="phone" name="phone" value="{{ old('phone') }}" required autofocus
                                   placeholder="Phone"
                                   class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }} no-border">
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
                            @endif
                        </div>
                        <div class="list-group-item">
                            <input type="password" name="password" placeholder="{{ __('Password') }}"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} no-border">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                            @endif
                        </div>
                        <div class="list-group-item">
                            <input type="password" name="password_confirmation"
                                   placeholder="{{ __('Confirm Password') }}"
                                   class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }} no-border">
                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="checkbox m-b">
                        <label>
                            <input type="checkbox"> Agree the <a href="#">terms and policy</a>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Sign up</button>
                    <div class="line line-dashed"></div>
                    <p class="text-muted text-center"><small>Already have an account?</small></p>
                    <a href="/login" class="btn btn-lg btn-default btn-block">Sign in</a>
                </form>
                <!-- footer -->
                <footer class="m-t-lg" id="footer">
                    <div class="text-center padder">
                        <p>
                            <small>Powered by PICTDA<br>&copy; {{ date('Y') }}</small>
                        </p>
                    </div>
                </footer>
                <!-- / footer -->
            </section>
        </div>
    </div>
@endsection
