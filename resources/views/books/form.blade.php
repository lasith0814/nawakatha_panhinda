<div class="card-header {{ $book->trashed() ? 'card-header-warning' : 'card-header-primary' }} ">
    <h4 class="card-title">{{ $book->id == null  ? 'Add Book' : 'Update Book' }}</h4>
    <p class="card-category"></p>
</div>
<div class="card-body ">
    @if($book->trashed())
        <div class="row">
            <div class="col-12 text-right">
                <a href="{{ route('books.inactive') }}" class="btn btn-sm btn-warning">{{ __('Back') }}</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12 text-right">
                <a href="{{ route('books.index') }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
            </div>
        </div>
    @endif
    <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('Book ID') }}</label>
        <div class="col-sm-7">
            <div class="form-group{{ $errors->has('book_id') ? ' has-danger' : '' }}">
                <input class="form-control{{ $errors->has('book_id') ? ' is-invalid' : '' }}" name="book_id" id="book_id" type="text" placeholder="{{ __('Book ID') }}" value="{{ old('book_id') ?? $book->book_id }}" aria-required="true" required />
                @if ($errors->has('book_id'))
                    <span id="name-error" class="error text-danger">{{ $errors->first('book_id') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('Book Name') }}</label>
        <div class="col-sm-7">
            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" type="text" placeholder="{{ __('Book Name') }}" value="{{ old('name') ?? $book->name  }}"  aria-required="true" required />
                @if ($errors->has('name'))
                    <span id="name-error" class="error text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('Book Category') }}</label>
        <div class="col-sm-7">
            <div class="form-group{{ $errors->has('ebook_category_id') ? ' has-danger' : '' }}">
                <select class="form-control" name="ebook_category_id" required>
                    <option value="" selected hidden >Select Category</option>
                    @foreach($categories as $category)
                        <option @if(old('ebook_category_id') == $category->id) selected @elseif($book->ebook_category_id == $category->id && old('ebook_category_id') == null ) selected @endif value="{{$category->id}}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('ebook_category_id'))
                <span id="name-error" class="error text-danger">{{ $errors->first('ebook_category_id') }}</span>
            @endif
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('Book Author') }}</label>
        <div class="col-sm-7">
            <div class="form-group{{ $errors->has('author_id') ? ' has-danger' : '' }}">
                <select class="form-control" name="author_id" required>
                    <option value="" selected hidden >Select Author</option>
                    @foreach($authors as $author)
                        <option @if(old('author_id') == $author->id) selected @elseif($book->author_id == $author->id && old('author_id') == null ) selected @endif value="{{$author->id}}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('author_id'))
                <span id="name-error" class="error text-danger">{{ $errors->first('author_id') }}</span>
            @endif
        </div>
    </div>
        <div class="row">
            <label class="col-sm-2 col-form-label">{{ __('Intro Quote') }}</label>
            <div class="col-sm-7">
                <div class="form-group{{ $errors->has('intro_quote') ? ' has-danger' : '' }}">
                    <textarea placeholder="Intro Quote..." class="form-control{{ $errors->has('intro_quote') ? ' is-invalid' : '' }}" name="intro_quote" id="intro_quote" rows="3" >{{ old('intro_quote') ? old('intro_quote') : $book->intro_quote }}</textarea>
                    @if ($errors->has('intro_quote'))
                        <span id="name-error" class="error text-danger">{{ $errors->first('intro_quote') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <label class="col-sm-2 col-form-label">{{ __('Cover Image') }}</label>
            <div class="col-sm-7">
                <div>
                    <input class="form-control{{ $errors->has('thumbnail_img') ? ' is-invalid' : '' }}" name="thumbnail_img" id="thumbnail_img" type="file" @if($book->id == null)  aria-required="true" required @endif />
                    @if ($errors->has('thumbnail_img'))
                        <span id="name-error" class="error text-danger">{{ $errors->first('thumbnail_img') }}</span> <br>
                    @endif
                    @if($book->thumbnail_img) <a href="{{asset("books/$book->id/$book->thumbnail_img")}}">Current Cover image</a> @endif
                </div>
            </div>
        </div>

        <div class="row">
            <label class="col-sm-2 col-form-label">{{ __('Back Image') }}</label>
            <div class="col-sm-7">
                <div>
                    <input class="form-control{{ $errors->has('back_thumbnail_img') ? ' is-invalid' : '' }}" name="back_thumbnail_img" id="back_thumbnail_img" type="file"/>

                    @if ($errors->has('back_thumbnail_img'))
                        <span id="name-error" class="error text-danger">{{ $errors->first('back_thumbnail_img') }}</span> <br>
                    @endif
                    @if($book->back_thumbnail_img)<a href="{{asset("books/$book->id/$book->back_thumbnail_img")}}">Current Back image</a>
                    <br>
                    <input type="checkbox" name="backImageDelete"> Delete Back Image
                    @endif
                </div>
            </div>
        </div>
</div>
