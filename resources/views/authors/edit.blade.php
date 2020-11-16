@extends('layouts.app', ['activePage' => 'Author', 'titlePage' => __('Update Author')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('Update Author') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('authors.index') }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <form method="post" action="{{ route('authors.update', $author) }}" class="form-horizontal">
                                    @method('patch')
                                    @include('authors.form')
                                        <div class="card-footer ml-auto mr-auto">
                                            <button type="submit" class="btn btn-primary">{{ __('Update Author') }}</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
