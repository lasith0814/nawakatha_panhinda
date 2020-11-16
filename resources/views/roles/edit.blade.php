@extends('layouts.app', ['activePage' => 'Role', 'titlePage' => __('Update User Role')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('Update User Role') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <form method="post" action="{{ route('roles.update', $role) }}" class="form-horizontal">
                                    @method('patch')
                                    @include('roles.form')
                                        <div class="card-footer ml-auto mr-auto">
                                            <button type="submit" class="btn btn-primary">{{ __('Update User Role') }}</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  @include('roles.script')
@endsection
