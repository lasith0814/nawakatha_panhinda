@extends('layouts.app', ['activePage' => 'User', 'titlePage' => __('Update User')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('users.update', $user) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('patch')
            <div class="card">
                @include('users.form')
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn {{ $user->trashed() ? 'btn-warning' : 'btn-primary' }}">{{ __('Update User') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>

        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('users.password', $user) }}" class="form-horizontal">
                    @csrf
                    @method('patch')

                    <div class="card ">
                        <div class="card-header {{ $user->trashed() ? 'card-header-warning' : 'card-header-primary' }}">
                            <h4 class="card-title">{{ __('Reset password') }}</h4>
                        </div>
                        <div class="card-body ">
                            @if (session('status_password'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="material-icons">close</i>
                                            </button>
                                            <span>{{ session('status_password') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="input-password">{{ __('New Password') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" value="abc@12345" type="password" placeholder="{{ __('New Password') }}" required />
                                        @if ($errors->has('password'))
                                            <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" value="abc@12345" placeholder="{{ __('Confirm New Password') }}" required />
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <label class="offset-2" for="">Default Password is abc@12345. But you can clear and change it </label>
                                </div>
                        </div>


                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn {{ $user->trashed() ? 'btn-warning' : 'btn-primary' }}">{{ __('Reset Password') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
  </div>
@endsection
