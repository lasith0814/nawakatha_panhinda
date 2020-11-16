@extends('layouts.app', ['activePage' => 'Author', 'titlePage' => __('View Author Profile')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('View Author Profile') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('authors.index') }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Author Name:') }}</label>
                                    <div class="col-sm-6" >
                                        <label style="background-color: #47bc85; color: #ffffff; border-radius:10px; padding: 5px 10px; margin: 2px" class="col-form-label">{{ $author->name }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Author Description:') }}</label>
                                    <div class="col-sm-6" >
                                        <label style="background-color: #47bc85; color: #ffffff; border-radius:10px; padding: 5px 10px; margin: 2px" class="col-form-label">@if($author->note != null) {!!nl2br($author->note)!!} @else - - - @endif</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Created By') }}</label>
                                    <div class="col-sm-7">
                                        <div>
                                            <label style="background-color: #ab47bc; color: #ffffff; border-radius:10px; padding: 5px 10px;"  class="col-form-label">
                                                {{$author->user->first_name}} {{$author->user->last_name ?? "-- -- --"}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Updated By') }}</label>
                                    <div class="col-sm-7">
                                        <div>
                                            <label style="background-color: #ab47bc; color: #ffffff; border-radius:10px; padding: 5px 10px;"  class="col-form-label">
                                                {{$author->user_update->first_name}} {{$author->user_update->last_name ?? "-- -- --"}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
