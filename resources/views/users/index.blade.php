@extends('layouts.app', ['activePage' => 'User', 'titlePage' => __('User Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('Users') }}</h4>
                            <p class="card-category"> {{ __('Here you can manage users') }}</p>
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
                            <div class="row">
                                <div class="col-6 text-left">
                                    <a href="{{ route('users.inactive') }}" class="btn btn-sm btn-warning">{{ __('Show Inactive') }}</a>
                                </div>
                                @can('create' , \App\User::class)
                                <div class="col-6 text-right">
                                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">{{ __('Add User') }}</a>
                                </div>
                                @endcan()
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>
                                        {{ __('First Name') }}
                                    </th>
                                    <th>
                                        {{ __('Last Name') }}
                                    </th>
                                    <th>
                                        {{ __('Role') }}
                                    </th>
                                    <th>
                                        {{ __('NIC') }}
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
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                {{ $user->first_name }}
                                            </td>
                                            <td>
                                                {{ $user->last_name ?? "---" }}
                                            </td>
                                            <td>
                                                {{ $user->userAccessRole->role_name }}
                                            </td>
                                            <td>
                                                {{ $user->nic }}
                                            </td>
                                            <td>
                                                {{ $user->user->first_name }}
                                            </td>
                                            <td>
                                                {{ $user->user_update->first_name }}
                                            </td>
                                            <td class="td-actions justify-content-end form-inline">
                                                @can('viewAny', \App\User::class)
                                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{route('users.show', $user)}}" data-original-title="" title="">
                                                        <i class="material-icons">visibility</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                @endcan
                                                @if(Auth::user()->id !== $user->id )
                                                @can('update', $user)
                                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{route('users.edit', $user)}}" data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                @endcan
                                                @can('delete', $user)
                                                        <form action="{{ route('users.deactivate', $user) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" class="btn btn-warning btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to Deactivate this user?") }}') ? this.parentElement.submit() : ''">
                                                                <i class="material-icons">delete_outline</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        </form>
                                                @endcan
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if($users->items()== null)
                                        <tr align="center"><td colspan="17"> System has no Users to show(Only Super Admin)</td> </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                                <div class="row align-items-center justify-content-center">
                                    {{ $users->links() }}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
