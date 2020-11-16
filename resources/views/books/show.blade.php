@extends('layouts.app', ['activePage' => 'Book', 'titlePage' => __('View Book') ])

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
                        <p class="card-category"> {{ __('View Count: '.$book->referredBooks->count()) }}</p>
                        <p class="card-category"> {{ __('Like Count: '.$likes) }}</p>
                        <p class="card-category"> {{ __('Page Count: '.$book->ebookPages->count()) }}</p>
                        @if($book->intro_quote != null)  <p class="card-category"> Intro Quote:
                     <div>{!!nl2br($book->intro_quote)!!}</div> </p> @endif
                    <p class="card-category"> Created By: {{$book->user_create->first_name}} {{$book->user_create->last_name ?? "-- -- --"}}</p>
                    <p class="card-category"> Updated By: {{$book->user_update->first_name}} {{$book->user_update->last_name ?? "-- -- --"}}</p>
                    @if($book->trashed())
                        <p class="card-category"> Inactivated By: {{$book->user_delete->first_name}} {{$book->user_delete->last_name ?? "-- -- --"}}</p>
                    @endif
                </div>
                  <div class="col-md-3 col-sm-4">
                      <p class="card-category"> {{ __('Cover Image') }}</p>
                      <img style="border-radius: 20px" src="{{asset("books/$book->id/$book->thumbnail_img")}}" alt="Cover Image">
                  </div>
                  <div class="col-md-3 col-sm-4">
                      <p class="card-category"> {{ __('Back Image') }}</p>
                      @if($book->back_thumbnail_img != null)
                          <img style="border-radius: 20px" src="{{asset("books/$book->id/$book->back_thumbnail_img")}}" alt="Back Image">
                      @else
                          <img style="border-radius: 20px" src="{{asset("books/no_book.jpg")}}" width="200" height="300" alt="Back Image">
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
                                  <div class="col-6 text-left">
                                      <a href="{{ route('books.inactive') }}" class="btn btn-sm btn-warning">{{ __('Back') }}</a>
                                  </div>
                          @else
                              <div class="col-6 text-left">
                                  <a href="{{ route('books.index') }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                              </div>
                          @endif
                          @can('create' , \App\EbookPage::class)
                              <div class="col-6 text-right">
                                  <a href="{{ route('pages.create', $book) }}" class="btn btn-sm @if($book->trashed()) btn-warning @else btn-primary  @endif">{{ __('Add Page') }}</a>
                              </div>
                          @endcan()
                      </div>
                      @can('viewAny' , \App\EbookPage::class)
                      <div class="table-responsive">
                          <table class="table">
                              <thead class=" text-primary">
                              <th>
                                  {{ __('Page Number') }}
                              </th>
                              <th>
                                  {{ __('Content') }}
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
                              @foreach($pages as $index => $page)
                                  <tr>
                                      <td>
                                          {{ $index + 1 }}
                                      </td>
                                      <td>
                                          {{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($page->contents)) , 50, $end='...')}}
                                      </td>
                                      <td>
                                          {{ $page->user_create->first_name }}
                                      </td>
                                      <td>
                                          {{ $page->user_update->first_name }}
                                      </td>
                                      <td class="td-actions justify-content-end form-inline">
                                          @can('viewAny', \App\EbookPage::class)
                                              <a rel="tooltip" class="btn btn-success btn-link" href="{{route('pages.show', [$book, $page])}}" data-original-title="" title="">
                                                  <i class="material-icons">visibility</i>
                                                  <div class="ripple-container"></div>
                                              </a>
                                          @endcan
                                          @can('update', $page)
                                              <a rel="tooltip" class="btn btn-success btn-link" href="{{route('pages.edit',[$book, $page])}}" data-original-title="" title="">
                                                  <i class="material-icons">edit</i>
                                                  <div class="ripple-container"></div>
                                              </a>
                                          @endcan
                                          @can('forceDelete', $page)
                                              <form action="{{ route('pages.delete',[$book, $page]) }}" method="post">
                                                  @csrf
                                                  @method('delete')
                                                  <button type="button" class="btn btn-danger btn-link" data-original-title="" title="" onclick="confirm('{{ __("Are you sure you want to Delete this page?") }}') ? this.parentElement.submit() : ''">
                                                      <i class="material-icons">delete</i>
                                                      <div class="ripple-container"></div>
                                                  </button>
                                              </form>
                                          @endcan
                                      </td>
                                  </tr>
                              @endforeach
                              @if($pages->items()== null)
                                  <tr align="center"><td colspan="17"> System has no Pages to show</td> </tr>
                              @endif
                              </tbody>
                          </table>
                      </div>
                      <div class="row align-items-center justify-content-center">
                          {{ $pages->links() }}
                      </div>
                      @endcan

              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection
