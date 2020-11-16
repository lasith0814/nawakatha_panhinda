<div class="card-header {{ $reader->trashed() ? 'card-header-warning' : 'card-header-primary' }} ">
    <h4 class="card-title">{{ $reader->id == null  ? 'Add Reader' : 'Update Reader' }}</h4>
    <p class="card-category"></p>
</div>
<div class="card-body ">
    @if($reader->trashed())
        <div class="row">
            <div class="col-12 text-right">
                <a href="{{ route('readers.inactive') }}" class="btn btn-sm btn-warning">{{ __('Back') }}</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12 text-right">
                <a href="{{ route('readers.index') }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
            </div>
        </div>
    @endif
    <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('First Name') }}</label>
        <div class="col-sm-7">
            <div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                <input class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" type="text" placeholder="{{ __('First Name') }}" value="{{ old('first_name') ?? $reader->first_name }}" aria-required="true" required />
                @if ($errors->has('first_name'))
                    <span id="name-error" class="error text-danger">{{ $errors->first('first_name') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('Last Name') }}</label>
        <div class="col-sm-7">
            <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="last_name" type="text" placeholder="{{ __('Last Name') }}" value="{{ old('last_name') ?? $reader->last_name  }}"  aria-required="true"  />
                @if ($errors->has('last_name'))
                    <span id="name-error" class="error text-danger">{{ $errors->first('last_name') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
        <div class="col-sm-7">
            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email') ?? $reader->email }}" required />
                @if ($errors->has('email'))
                    <span id="email-error" class="error text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('Mobile') }}</label>
        <div class="col-sm-7">
            <div class="form-group{{ $errors->has('mobile') ? ' has-danger' : '' }}">
                <input class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" id="mobile" type="text" placeholder="{{ __('Mobile Number') }}" value="{{ old('mobile') ?? $reader->mobile }}" required />
                @if ($errors->has('mobile'))
                    <span id="name-error" class="error text-danger">{{ $errors->first('mobile') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('Reader Role') }}</label>
        <div class="col-sm-7">
            <div class="form-group{{ $errors->has('reader_access_role_id') ? ' has-danger' : '' }}">
                <select class="form-control" name="reader_access_role_id" required>
                    <option value="" selected hidden >Select Reader Role</option>
                    @foreach($types as $role)
                        <option @if(old('reader_access_role_id') == $role->id) selected @elseif($reader->reader_access_role_id == $role->id && old('reader_access_role_id') == null ) selected @endif value="{{$role->id}}">{{ $role->role_name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('reader_access_role_id'))
                <span id="name-error" class="error text-danger">{{ $errors->first('reader_access_role_id') }}</span>
            @endif
        </div>
    </div>
</div>
