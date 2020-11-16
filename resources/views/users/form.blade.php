<div class="card-header {{ $user->trashed() ? 'card-header-warning' : 'card-header-primary' }} ">
    <h4 class="card-title">{{ $user->id == null  ? 'Add User' : 'Update User' }}</h4>
    <p class="card-category"></p>
</div>
<div class="card-body ">
    @if($user->trashed())
        <div class="row">
            <div class="col-12 text-right">
                <a href="{{ route('users.inactive') }}" class="btn btn-sm btn-warning">{{ __('Back') }}</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-12 text-right">
                <a href="{{ route('users.index') }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
            </div>
        </div>
    @endif
    <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('First Name') }}</label>
        <div class="col-sm-7">
            <div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                <input class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" type="text" placeholder="{{ __('First Name') }}" value="{{ old('first_name') ?? $user->first_name }}" aria-required="true" required />
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
                <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" id="last_name" type="text" placeholder="{{ __('Last Name') }}" value="{{ old('last_name') ?? $user->last_name  }}"  aria-required="true"  />
                @if ($errors->has('last_name'))
                    <span id="name-error" class="error text-danger">{{ $errors->first('last_name') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('NIC') }}</label>
        <div class="col-sm-7">
            <div class="form-group{{ $errors->has('nic') ? ' has-danger' : '' }}">
                <input class="form-control{{ $errors->has('nic') ? ' is-invalid' : '' }}" name="nic" id="nic" type="text" placeholder="{{ __('NIC') }}" value="{{ old('nic') ?? $user->nic }}" required />
                @if ($errors->has('nic'))
                    <span id="name-error" class="error text-danger">{{ $errors->first('nic') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
        <div class="col-sm-7">
            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email') ?? $user->email }}" required />
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
                <input class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" id="mobile" type="text" placeholder="{{ __('Mobile Number') }}" value="{{ old('mobile') ?? $user->mobile }}" required />
                @if ($errors->has('mobile'))
                    <span id="name-error" class="error text-danger">{{ $errors->first('mobile') }}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-2 col-form-label">{{ __('User Role') }}</label>
        <div class="col-sm-7">
            <div class="form-group{{ $errors->has('user_access_role_id') ? ' has-danger' : '' }}">
                <select class="form-control" name="user_access_role_id" required>
                    <option value="" selected hidden >Select User Role</option>
                    @foreach($types as $role)
                        <option @if(old('user_access_role_id') == $role->id) selected @elseif($user->user_access_role_id == $role->id && old('user_access_role_id') == null ) selected @endif value="{{$role->id}}">{{ $role->role_name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('user_access_role_id'))
                <span id="name-error" class="error text-danger">{{ $errors->first('user_access_role_id') }}</span>
            @endif
        </div>
    </div>
</div>
