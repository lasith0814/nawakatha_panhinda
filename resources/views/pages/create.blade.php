@extends('layouts.app', ['activePage' => 'Book', 'titlePage' => __('Create Page')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('pages.store' , $book) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
            <div class="card">
                @include('pages.form')

              <div class="card-footer ml-auto mr-auto">
                  <button type="submit" class="btn {{ $book->trashed() ? 'btn-warning' : 'btn-primary ' }}">{{ __('Add Page') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
