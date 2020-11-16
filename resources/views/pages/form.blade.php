@section('tinymce')
    <script src="{{asset('tinymce/js/tinymce/tinymce.min.js')}}" referrerpolicy="origin"></script>
    <script>tinymce.init({
            selector:'textarea',
            plugins: 'link code contextmenu',
            height: 500,
            toolbar_mode: 'scrolling',
            contextmenu: "cut | copy | paste |"
    });</script>
@endsection
<div class="card-header {{ $book->trashed() ? 'card-header-warning' : 'card-header-primary' }} ">
    <h4 class="card-title">{{ $page->id == null  ? 'Add Page' : 'Update Page' }}</h4>
    <p class="card-category"></p>
</div>
<div class="card-body ">
    @if($book->trashed())
        <div class="row">
            <div class="col-12 text-right">
                <a href="{{ route('books.show' , $book) }}" class="btn btn-sm btn-warning">{{ __('Back') }}</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12 text-right">
                <a href="{{ route('books.show' , $book) }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
            </div>
        </div>
    @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group{{ $errors->has('contents') ? ' has-danger' : '' }}">
                    <textarea placeholder="Page Content..." class="form-control{{ $errors->has('contents') ? ' is-invalid' : '' }}" name="contents" id="contents" rows="10">{{ old('contents') ? old('contents') : $page->contents }}</textarea>
                    @if ($errors->has('contents'))
                        <span id="name-error" class="error text-danger">{{ $errors->first('contents') }}</span>
                    @endif
                </div>
            </div>
        </div>
</div>
