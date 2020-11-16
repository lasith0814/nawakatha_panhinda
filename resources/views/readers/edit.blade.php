@extends('layouts.app', ['activePage' => 'Reader', 'titlePage' => __('Update Reader')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('readers.update', $reader) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('patch')
            <div class="card">
                @include('readers.form')
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn {{ $reader->trashed() ? 'btn-warning' : 'btn-primary' }}">{{ __('Update Reader') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>

        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ route('readers.password', $reader) }}" class="form-horizontal">
                    @csrf
                    @method('patch')

                    <div class="card ">
                        <div class="card-header {{ $reader->trashed() ? 'card-header-warning' : 'card-header-primary' }}">
                            <h4 class="card-title">{{ __('Reset Pin') }}</h4>
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
                                <label class="col-sm-2 col-form-label" for="input-password">{{ __('New Pin') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" value="123456" type="password" placeholder="{{ __('New Pin') }}" required />
                                        @if ($errors->has('password'))
                                            <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm New Pin') }}</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" value="123456" placeholder="{{ __('Confirm New Pin') }}" required />
                                    </div>
                                </div>
                            </div>
                                <div class="row">
                                    <label class="offset-2" for="">Default Pin is 123456. But you can clear and change it </label>
                                </div>
                        </div>


                        <div class="card-footer ml-auto mr-auto">
                            <button type="submit" class="btn {{ $reader->trashed() ? 'btn-warning' : 'btn-primary' }}">{{ __('Reset Pin') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
  </div>
@endsection
