@extends('layouts.app', ['activePage' => 'Author', 'titlePage' => __('Author Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('Authors') }}</h4>
                            <p class="card-category"> {{ __('Here you can manage authors') }}</p>
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
                            @can('create', \App\Author::class)
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('authors.create') }}" class="btn btn-sm btn-primary">{{ __('Add Author') }}</a>
                                </div>
                            </div>
                            @endcan
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <th>
                                        {{ __('Author Name') }}
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
                                    @foreach($authors as $author)
                                    <tr>
                                    <td>
                                        {{ $author->name }}
                                    </td>
                                    <td>
                                        {{ $author->user->first_name }}
                                    </td>
                                    <td>
                                        {{ $author->user_update->first_name }}
                                    </td>
                                    <td class="td-actions text-right">
                                        @can('viewAny', \App\Author::class)
                                        <a rel="tooltip" class="btn btn-success btn-link" href="{{route('authors.show', $author)}}" data-original-title="" title="">
                                            <i class="material-icons">visibility</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                        @endcan
                                        @can('update', $author)
                                        <a rel="tooltip" class="btn btn-success btn-link" href="{{route('authors.edit', $author)}}" data-original-title="" title="">
                                            <i class="material-icons">edit</i>
                                            <div class="ripple-container"></div>
                                        </a>
                                        @endcan
                                    </td>
                                    </tr>
                                    @endforeach
                                    @if($authors->items()== null)
                                    <tr align="center"><td colspan="17"> System has no Authors to show</td> </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                                <div class="row align-items-center justify-content-center">
                                    {{ $authors->links() }}
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
