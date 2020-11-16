@extends('layouts.app', ['activePage' => 'Reader', 'titlePage' => __('Reader Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('Readers') }}</h4>
                            <p class="card-category"> {{ __('Here you can manage readers') }}</p>
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
                                    <a href="{{ route('readers.inactive') }}" class="btn btn-sm btn-warning">{{ __('Show Inactive') }}</a>
                                </div>
                                @can('create' , \App\Reader::class)
                                <div class="col-6 text-right">
                                    <a href="{{ route('readers.create') }}" class="btn btn-sm btn-primary">{{ __('Add Reader') }}</a>
                                </div>
                                @endcan()
                            </div>
                                <form method="GET" action="{{ route('readers.index') }}" >
                                    <div class="row">
                                        <div class="col-md-10 col-sm-9">
                                            <div class="form-group{{ $errors->has('search') ? ' has-danger' : '' }}">
                                                <input class="form-control{{ $errors->has('search') ? ' is-invalid' : '' }}" name="search" id="search" type="text" placeholder="{{ __('Search By Name, Email or Mobile') }}" value="{{ old('search') ?? app('request')->input('search')}}" />
                                                @if ($errors->has('search'))
                                                    <span id="name-error" class="error text-danger">{{ $errors->first('search') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-3 text-right">
                                            <button type="submit" class="btn btn-sm btn-outline-primary btn-block">{{ __('Search') }}</button>
                                        </div>
                                    </div>
                                </form>
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
                                        {{ __('Mobile') }}
                                    </th>
                                    <th>
                                        {{ __('Email') }}
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
                                    @foreach($readers as $reader)
                                        <tr>
                                            <td>
                                                {{ $reader->first_name }}
                                            </td>
                                            <td>
                                                {{ $reader->last_name ?? "---" }}
                                            </td>
                                            <td>
                                                {{ $reader->readerAccessRole->role_name }}
                                            </td>
                                            <td>
                                                {{ $reader->mobile }}
                                            </td>
                                            <td>
                                                {{ $reader->email }}
                                            </td>
                                            <td>
                                                {{ $reader->user->first_name }}
                                            </td>
                                            <td>
                                                {{ $reader->user_update->first_name }}
                                            </td>
                                            <td class="td-actions justify-content-end form-inline">
                                                @can('viewAny', \App\Reader::class)
                                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{route('readers.show', $reader)}}" data-original-title="" title="">
                                                        <i class="material-icons">visibility</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                @endcan
                                                @can('update', $reader)
                                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{route('readers.edit', $reader)}}" data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                @endcan
                                                @can('delete', $reader)
                                                        <form action="{{ route('readers.deactivate', $reader) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" class="btn btn-warning btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to Deactivate this reader?") }}') ? this.parentElement.submit() : ''">
                                                                <i class="material-icons">delete_outline</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if($readers->items()== null)
                                        <tr align="center"><td colspan="17"> System has no Readers to show</td> </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                                <div class="row align-items-center justify-content-center">
                                    {{ $readers->links() }}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
