@extends('layouts.app', ['activePage' => 'Role', 'titlePage' => __('Role Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('User Roles') }}</h4>
                            <p class="card-category"> {{ __('Here you can manage user roles') }}</p>
                        </div>
                        <div class="card-body">
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
                            @can('create', \App\UserAccessRole::class)
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary">{{ __('Add User Role') }}</a>
                                </div>
                            </div>
                            @endcan
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>
                                        {{ __('Role Name') }}
                                    </th>
                                    <th>
                                        {{ __('Created By') }}
                                    </th>
                                    <th>
                                        {{ __('Updated By') }}
                                    </th>
                                    <th class="text-right">
                                        {{ __('Actions') }}
                                    </th>

                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                    <tr>
                                    <td>
                                        {{ $role->role_name }}
                                    </td>
                                    <td>
                                        {{ $role->user->first_name }}
                                    </td>
                                    <td>
                                        {{ $role->user_update->first_name }}
                                    </td>
                                    <td class="td-actions text-right">
                                        @can('viewAny', \App\UserAccessRole::class)
                                        <a rel="tooltip" class="btn btn-success btn-link" href="{{route('roles.show', $role)}}" data-original-title="" title="">
                                            <i class="material-icons">visibility</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                        @endcan
                                        @if(Auth::user()->userAccessRole->id !== $role->id )
                                        @can('update', $role)
                                        <a rel="tooltip" class="btn btn-success btn-link" href="{{route('roles.edit', $role)}}" data-original-title="" title="">
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                        @endcan
                                        @endif
                                    </td>
                                    </tr>
                                    @endforeach
                                    @if($roles->items()== null)
                                    <tr align="center"><td colspan="17"> System has no Roles to show</td> </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                                <div class="row align-items-center justify-content-center">
                                    {{ $roles->links() }}
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
