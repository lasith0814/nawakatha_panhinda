@extends('layouts.app', ['activePage' => 'User', 'titlePage' => __('View User Profile') ])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

            <div class="card ">
              <div class="card-header {{ $user->trashed() ? 'card-header-warning' : 'card-header-primary' }} ">
                <h4 class="card-title">{{ __('View User Profile') }}{{$user->trashed() ? ' - Inactivated User' : ''}}</h4>
              </div>
              <div class="card-body ">
                  @if($user->trashed())
                      <div class="row">
                          <div class="col-12 text-right">
                              <a href="{{ route('users.inactive') }}" class="btn btn-sm btn-warning">{{ __('Back') }}</a>
                          </div>
                      </div>
                  @else
                  <div class="row">
                      <div class="col-12 text-right">
                          <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                      </div>
                  </div>
                  @endif
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                        <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('First Name') }}</label>
                            <div class="col-sm-7">
                                <div>
                                    <label style="background-color: #ab47bc; color: #ffffff; border-radius:10px; padding: 5px 10px;"  class="col-form-label">
                                        {{$user->first_name}}
                                    </label>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Last Name') }}</label>
                        <div class="col-sm-7">
                            <div>
                                <label style="background-color: #ab47bc; color: #ffffff; border-radius:10px; padding: 5px 10px;" class="col-form-label">
                                    {{$user->last_name ?? "-- -- --"}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('NIC') }}</label>
                        <div class="col-sm-7">
                            <div>
                                <label style="background-color: #ab47bc; color: #ffffff; border-radius:10px; padding: 5px 10px;"  class="col-form-label">
                                    {{$user->nic}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('User Role') }}</label>
                        <div class="col-sm-7">
                            <div>
                                <label style="background-color: #47bc85; color: #ffffff; border-radius:10px; padding: 5px 10px;"  class="col-form-label">
                                    {{$user->userAccessRole->role_name}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                        <div class="col-sm-7">
                            <div>
                                <label style="background-color: #ab47bc; color: #ffffff; border-radius:10px; padding: 5px 10px;"  class="col-form-label">
                                    {{$user->email}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Mobile') }}</label>
                        <div class="col-sm-7">
                            <div>
                                <label style="background-color: #ab47bc; color: #ffffff; border-radius:10px; padding: 5px 10px;"  class="col-form-label">
                                    {{$user->mobile}}
                                </label>
                            </div>
                        </div>
                    </div>
                      <div class="row">
                          <label class="col-sm-2 col-form-label">{{ __('Created By') }}</label>
                          <div class="col-sm-7">
                              <div>
                                  <label style="background-color: #ab47bc; color: #ffffff; border-radius:10px; padding: 5px 10px;"  class="col-form-label">
                                      {{$user->user->first_name}} {{$user->user->last_name ?? "-- -- --"}}
                                  </label>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <label class="col-sm-2 col-form-label">{{ __('Updated By') }}</label>
                          <div class="col-sm-7">
                              <div>
                                  <label style="background-color: #ab47bc; color: #ffffff; border-radius:10px; padding: 5px 10px;"  class="col-form-label">
                                      {{$user->user_update->first_name}} {{$user->user_update->last_name ?? "-- -- --"}}
                                  </label>
                              </div>
                          </div>
                      </div>
                      @if($user->trashed())
                          <div class="row">
                              <label class="col-sm-2 col-form-label">{{ __('Deleted By') }}</label>
                              <div class="col-sm-7">
                                  <div>
                                      <label style="background-color: #ab47bc; color: #ffffff; border-radius:10px; padding: 5px 10px;"  class="col-form-label">
                                          {{$user->user_delete->first_name}} {{$user->user_delete->last_name ?? "-- -- --"}}
                                      </label>
                                  </div>
                              </div>
                          </div>
                      @endif
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
