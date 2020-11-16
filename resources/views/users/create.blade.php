@extends('layouts.app', ['activePage' => 'User', 'titlePage' => __('Create User')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('users.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
            <div class="card">
                @include('users.form')
                <div class="card-body ">
                <div class="row">
                    <label class="col-sm-2 col-form-label" for="input-password">{{ __('Password') }}</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" value="abc@12345" id="input-password" placeholder="{{ __('Password') }}"  required />
                            @if ($errors->has('password'))
                                <span id="name-error" class="error text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm Password') }}</label>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" value="abc@12345" placeholder="{{ __('Confirm Password') }}" required />
                            @if ($errors->has('password_confirmation'))
                                <span id="name-error" class="error text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="offset-sm-2" for="">Default Password is abc@12345. But you can clear and change it </label>
                </div>
            </div>

              <div class="card-footer ml-auto mr-auto">
                  <button type="submit" class="btn btn-primary">{{ __('Add User') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
