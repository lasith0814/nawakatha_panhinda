@csrf
<div class="row">
    <label class="col-sm-2 col-form-label">{{ __('Author Name') }}</label>
    <div class="col-sm-7">
        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" type="text" placeholder="{{ __('Author Name') }}" value="{{ old('name') ? old('name') : $author->name }}" required="true" aria-required="true"/>
            @if ($errors->has('name'))
                <span id="name-error" class="error text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <label class="col-sm-2 col-form-label">{{ __('Author Description') }}</label>
    <div class="col-sm-7">
        <div class="form-group{{ $errors->has('note') ? ' has-danger' : '' }}">
            <textarea placeholder="Describe about author..." class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" id="note" rows="3" >{{ old('note') ? old('note') : $author->note }}</textarea>
            @if ($errors->has('note'))
                <span id="name-error" class="error text-danger">{{ $errors->first('note') }}</span>
            @endif
        </div>
    </div>
</div>
