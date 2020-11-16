@csrf
<div class="row">
    <label class="col-sm-2 col-form-label">{{ __('Role Name') }}</label>
    <div class="col-sm-7">
        <div class="form-group{{ $errors->has('role_name') ? ' has-danger' : '' }}">
            <input class="form-control{{ $errors->has('role_name') ? ' is-invalid' : '' }}" name="role_name" id="role_name" type="text" placeholder="{{ __('Role Name') }}" value="{{ old('role_name') ? old('role_name') : $role->role_name }}" required="true" aria-required="true"/>
            @if ($errors->has('role_name'))
                <span id="name-error" class="error text-danger">{{ $errors->first('role_name') }}</span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <label class="col-sm-2 col-form-label">{{ __('Permission') }}</label>
    @foreach($types as $type)
        @if($type->id == 6)  <div class = "col-sm-2"></div> @endif
        <div class = "col-sm-2" style="padding-right: 10px; padding-left: 10px;">
            <label class="col-form-label">{{ $type->name }}</label>
            @foreach($type->userActions as $action)
                <div class="form-check">
                    <input type="checkbox" @if(old('_token') === null) {{  in_array($action->id, $array) ? ' checked' : '' }} @endif {{ (is_array(old('actions')) and in_array($action->id , old('actions'))) ? ' checked' : '' }} name="actions[]" value="{{$action->id}}" id="{{$action->div_id}}" @if(in_array($action->id , [1,5,8,12,17,21,24])) onchange="{{$action->div_id}}F(this)" @endif >
                    <label class="form-check-label" style="padding-left: 0px;" >{{$action->font_text}}</label>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
<div class="row offset-sm-2">
    @if ($errors->has('actions'))
        <span id="name-error" class="error text-danger">{{ $errors->first('actions') }}</span>
    @endif
</div>
