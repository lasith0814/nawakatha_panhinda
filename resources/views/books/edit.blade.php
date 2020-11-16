@extends('layouts.app', ['activePage' => 'Book', 'titlePage' => __('Update Book')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('books.update', $book) }}" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
            @csrf
            @method('patch')
            <div class="card">
                @include('books.form')
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn {{ $book->trashed() ? 'btn-warning' : 'btn-primary' }}">{{ __('Update Book') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
