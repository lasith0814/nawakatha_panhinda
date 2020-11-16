@extends('layouts.app-guest', ['class' => 'off-canvas-sidebar', 'title' => __('Nawakatha Panhinda')])
@section('content')
    <div class="container" style="height: auto;" data-color="green">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card card-login card-hidden mb-3">
                        <div class="card-header card-header-primary text-center">
                            <h4 class="card-title"><strong>{{ __('Login') }}</strong></h4>
                        </div>
                        @if(session()->has('message_csrf'))
                        <br>
                        <p style="padding: 2px 3px;text-align: center; font-family: Roboto; background-color: rgb(175,147,46); color: white; border-radius: 10px">
                            <strong>{!! session()->get('message_csrf') !!} </strong></p>
                        @endif
                        {{ session()->forget('message_csrf') }}
                        <div class="card-body">
                            <div class="bmd-form-group{{ $errors->has('nic') ? ' has-danger' : '' }}">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">credit_card</i>
                                      </span>
                                    </div>
                                    <input type="text" name="nic" class="form-control" placeholder="{{ __('NIC...') }}" value="{{ old('nic') }}" required>
                                </div>
                                @if ($errors->has('nic'))
                                    <div id="email-error" class="error text-danger pl-3" for="nic" style="display: block;">
                                        <strong>{{ $errors->first('nic') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="bmd-form-group{{ $errors->has('password') ? 'has-danger' : '' }} mt-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="material-icons">lock_outline</i>
                                      </span>
                                    </div>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password...') }}" required>
                                </div>
                                @if ($errors->has('password'))
                                    <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-check mr-auto ml-3 mt-3">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember me') }}
                                    <span class="form-check-sign">
                                      <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="card-footer justify-content-center">
                            <button type="submit" class="btn btn-primary btn-link btn-lg">{{ __('Login') }}</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-6">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-light">
                                <small>{{ __('Forgot password?') }}</small>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
