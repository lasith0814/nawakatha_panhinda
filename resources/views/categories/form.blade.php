@csrf
<div class="row">
    <label class="col-sm-2 col-form-label">{{ __('Book Category Name') }}</label>
    <div class="col-sm-7">
        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
            <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" type="text" placeholder="{{ __('Book Category Name') }}" value="{{ old('name') ? old('name') : $category->name }}" required="true" aria-required="true"/>
            @if ($errors->has('name'))
                <span id="name-error" class="error text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <label class="col-sm-2 col-form-label">{{ __('Book Category Description') }}</label>
    <div class="col-sm-7">
        <div class="form-group{{ $errors->has('note') ? ' has-danger' : '' }}">
            <textarea placeholder="Describe about book category..." class="form-control{{ $errors->has('note') ? ' is-invalid' : '' }}" name="note" id="note" rows="3" >{{ old('note') ? old('note') : $category->note }}</textarea>
            @if ($errors->has('note'))
                <span id="name-error" class="error text-danger">{{ $errors->first('note') }}</span>
            @endif
        </div>
    </div>
</div>
