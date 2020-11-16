@extends('layouts.app', ['activePage' => 'Category', 'titlePage' => __('View Book Category')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">{{ __('View Book Category') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Book Category Name:') }}</label>
                                    <div class="col-sm-6" >
                                        <label style="background-color: #47bc85; color: #ffffff; border-radius:10px; padding: 5px 10px; margin: 2px" class="col-form-label">{{ $category->name }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Category Description:') }}</label>
                                    <div class="col-sm-6" >
                                        <label style="background-color: #47bc85; color: #ffffff; border-radius:10px; padding: 5px 10px; margin: 2px" class="col-form-label"> @if($category->note != null) {!!nl2br($category->note)!!} @else - - - @endif</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Created By') }}</label>
                                    <div class="col-sm-7">
                                        <div>
                                            <label style="background-color: #ab47bc; color: #ffffff; border-radius:10px; padding: 5px 10px;"  class="col-form-label">
                                                {{$category->user->first_name}} {{$category->user->last_name ?? "-- -- --"}}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">{{ __('Updated By') }}</label>
                                    <div class="col-sm-7">
                                        <div>
                                            <label style="background-color: #ab47bc; color: #ffffff; border-radius:10px; padding: 5px 10px;"  class="col-form-label">
                                                {{$category->user_update->first_name}} {{$category->user_update->last_name ?? "-- -- --"}}
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
