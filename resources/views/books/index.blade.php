@extends('layouts.app', ['activePage' => 'Book', 'titlePage' => __('Book Management')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('Books') }}</h4>
                            <p class="card-category"> {{ __('Here you can manage books') }}</p>
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
                                    <a href="{{ route('books.inactive') }}" class="btn btn-sm btn-warning">{{ __('Show Inactive') }}</a>
                                </div>
                                @can('create' , \App\Ebook::class)
                                <div class="col-6 text-right">
                                    <a href="{{ route('books.create') }}" class="btn btn-sm btn-primary">{{ __('Add Book') }}</a>
                                </div>
                                @endcan()
                            </div>
                                <form method="GET" action="{{ route('books.index') }}" >
                                    <div class="row">
                                        <div class="col-md-10 col-sm-9">
                                            <div class="form-group{{ $errors->has('search') ? ' has-danger' : '' }}">
                                                <input class="form-control{{ $errors->has('search') ? ' is-invalid' : '' }}" name="search" id="search" type="text" placeholder="{{ __('Search By ID, Name, Author or Category') }}" value="{{ old('search') ?? app('request')->input('search')}}" />
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
                                        {{ __('Book ID') }}
                                    </th>
                                    <th>
                                        {{ __('Book Name') }}
                                    </th>
                                    <th>
                                        {{ __('Category') }}
                                    </th>
                                    <th>
                                        {{ __('Author') }}
                                    </th>
                                    <th>
                                        {{ __('Views') }}
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
                                    @foreach($books as $book)
                                        <tr>
                                            <td>
                                                {{ $book->book_id }}
                                            </td>
                                            <td>
                                                {{ \Illuminate\Support\Str::limit( $book->name, 25, $end='...')}}
                                            </td>
                                            <td>
                                                {{ \Illuminate\Support\Str::limit($book->ebookCategory->name, 10, $end='...')  }}
                                            </td>
                                            <td>
                                                {{  \Illuminate\Support\Str::limit($book->author->name, 10, $end='...') }}
                                            </td>
                                            <td>
                                                {{ $book->referredBooks->count()}}
                                            </td>
                                            <td>
                                                {{ $book->user_create->first_name }}
                                            </td>
                                            <td>
                                                {{ $book->user_update->first_name }}
                                            </td>
                                            <td class="td-actions justify-content-end form-inline">
                                                @can('viewAny', \App\Ebook::class)
                                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{route('books.show', $book)}}" data-original-title="" title="">
                                                        <i class="material-icons">visibility</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                @endcan
                                                @can('update', $book)
                                                    <a rel="tooltip" class="btn btn-success btn-link" href="{{route('books.edit', $book)}}" data-original-title="" title="">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                @endcan
                                                @can('delete', $book)
                                                        <form action="{{ route('books.deactivate', $book) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" class="btn btn-warning btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to Deactivate this book?") }}') ? this.parentElement.submit() : ''">
                                                                <i class="material-icons">delete_outline</i>
                                                                <div class="ripple-container"></div>
                                                            </button>
                                                        </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if($books->items()== null)
                                        <tr align="center"><td colspan="17"> System has no Books to show</td> </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                                <div class="row align-items-center justify-content-center">
                                    {{ $books->links() }}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
