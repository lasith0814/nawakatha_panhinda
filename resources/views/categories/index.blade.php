@extends('layouts.app', ['activePage' => 'Category', 'titlePage' => __('Books Category Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('Books Category') }}</h4>
                            <p class="card-category"> {{ __('Here you can manage books categories') }}</p>
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
                            @can('create', \App\EbookCategory::class)
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">{{ __('Add Category') }}</a>
                                </div>
                            </div>
                            @endcan
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>
                                        {{ __('Category Name') }}
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
                                    @foreach($categories as $category)
                                    <tr>
                                    <td>
                                        {{ $category->name }}
                                    </td>
                                    <td>
                                        {{ $category->user->first_name }}
                                    </td>
                                    <td>
                                        {{ $category->user_update->first_name }}
                                    </td>
                                    <td class="td-actions text-right">
                                        @can('viewAny', \App\EbookCategory::class)
                                        <a rel="tooltip" class="btn btn-success btn-link" href="{{route('categories.show', $category)}}" data-original-title="" title="">
                                            <i class="material-icons">visibility</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                        @endcan
                                        @can('update', $category)
                                        <a rel="tooltip" class="btn btn-success btn-link" href="{{route('categories.edit', $category)}}" data-original-title="" title="">
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                        @endcan
                                    </td>
                                    </tr>
                                    @endforeach
                                    @if($categories->items()== null)
                                    <tr align="center"><td colspan="17"> System has no Category to show</td> </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                                <div class="row align-items-center justify-content-center">
                                    {{ $categories->links() }}
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
