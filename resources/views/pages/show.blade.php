@extends('layouts.app', ['activePage' => 'Book', 'titlePage' => __('View Book Page') ])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card ">
              <div class="row card-header {{ $book->trashed() ? 'card-header-warning' : 'card-header-primary' }} ">
                <div class="col-md-6 col-sm-4">
                      <h4 class="card-title">{{ __('Book Name: '. $book->name) }}{{$book->trashed() ? ' - Inactivated Book' : ''}}</h4>
                        <p class="card-category"> {{ __('Book ID: '. $book->book_id) }}</p>
                        <p class="card-category"> {{ __('Book Category: '.$book->ebookCategory->name) }}</p>
                        <p class="card-category"> {{ __('Book Author: '.$book->author->name) }}</p>
                        <p class="card-category"> {{ __('Page Number: '.$page_number) }}</p>
                    <p class="card-category"> Created By: {{$book->user_create->first_name}} {{$book->user_create->last_name ?? "-- -- --"}}</p>
                    <p class="card-category"> Updated By: {{$book->user_update->first_name}} {{$book->user_update->last_name ?? "-- -- --"}}</p>
                    @if($book->trashed())
                        <p class="card-category"> Inactivated By: {{$book->user_delete->first_name}} {{$book->user_delete->last_name ?? "-- -- --"}}</p>
                    @endif
                </div>
                </div>

              <div class="card-body ">
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
                          @if($book->trashed())
                                  <div class="col-12 text-right">
                                      <a href="{{ route('books.show' , $book) }}" class="btn btn-sm btn-warning">{{ __('Back') }}</a>
                                  </div>
                          @else
                              <div class="col-12 text-right">
                                  <a href="{{ route('books.show' , $book) }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                              </div>
                          @endif
                      </div>
                      @can('viewAny' , \App\EbookPage::class)
                          <div class="row">
                              <div class="col-12">
                                  {!! $page->contents !!}
                              </div>
                          </div>
                      @endcan

              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
