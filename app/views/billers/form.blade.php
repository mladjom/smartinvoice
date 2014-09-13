<div class="row">
    <div class="col-md-3">
        <div class="form-group {{{ $errors->has('logo') ? 'has-error' : '' }}}">
            <label for="logo">{{ Lang::get('billers.label.logo') }}</label>
            <p class="help-block">{{ Lang::get('billers.help.logo') }}</p>
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 240px; height: 120px;">
                    @if ( isset($biller)  )
                    @if (  File::exists($biller->image_path_thumbnail) )
                    {{ HTML::image($biller->image_path_thumbnail, $biller->image_name) }}
                    @endif
                    @else                        
                    <img class="img-responsive" src="http://placehold.it/240x120" alt="...">
                    @endif
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 240px; max-height: 120px;">
                </div>
                <div>
                    <span class="btn btn-default btn-file"><span class="fileinput-new">{{ Lang::get('general.select_image') }}</span>
                        <span class="fileinput-exists">{{ Lang::get('general.change') }}</span>
                        <input type="file" name="logo" id="logo"></span>
                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">{{ Lang::get('general.remove') }}</a>
                </div>
            </div>
            {{ $errors->first('logo', '<span class="help-block">:message</span>') }}
        </div>
    </div>
    <div class="col-md-9">

        <!-- name -->
        <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
            <label class="control-label" for="name">{{ Lang::get('billers.label.name') }}</label>
            <input class="form-control" type="text" name="name" id="name" placeholder="{{ Lang::get('billers.placeholder.name') }}" value="{{{ Input::old('name', isset($biller) ? $biller->name : null) }}}" />
            {{ $errors->first('name', '<span class="help-block">:message</span>') }}
        </div>
        <!-- ./ name -->
        <div class="row">
            <div class="col-md-6">
                <!-- address_1 -->
                <div class="form-group {{{ $errors->has('address_1') ? 'has-error' : '' }}}">
                    <label class="control-label" for="address_1">{{ Lang::get('billers.label.address_1') }}</label>
                    <input class="form-control" type="text" name="address_1" id="address_1" placeholder="{{ Lang::get('billers.placeholder.address_1') }}" value="{{{ Input::old('address_1', isset($biller) ? $biller->address_1 : null) }}}" />
                    {{ $errors->first('address_1', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ address_1 -->
            </div>
            <div class="col-md-6">
                <!-- address_2 -->
                <div class="form-group {{{ $errors->has('address_2') ? 'has-error' : '' }}}">
                    <label class="control-label" for="address_2">{{ Lang::get('billers.label.address_2') }}</label>
                    <input class="form-control" type="text" name="address_2" id="address_2" placeholder="{{ Lang::get('billers.placeholder.address_2') }}" value="{{{ Input::old('address_2', isset($biller) ? $biller->address_2 : null) }}}" />
                    {{ $errors->first('address_2', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ address_2 -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <!-- city -->
                <div class="form-group {{{ $errors->has('city') ? 'has-error' : '' }}}">
                    <label class="control-label" for="city">{{ Lang::get('billers.label.city') }}</label>
                    <input class="form-control" type="text" name="city" id="city" placeholder="{{ Lang::get('billers.placeholder.city') }}" value="{{{ Input::old('city', isset($biller) ? $biller->city : null) }}}" />
                    {{ $errors->first('city', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ city -->  
            </div>
            <div class="col-md-2">
                <!-- zip -->
                <div class="form-group {{{ $errors->has('zip') ? 'has-error' : '' }}}">
                    <label class="control-label" for="zip">{{ Lang::get('billers.label.zip') }}</label>
                    <input class="form-control" type="text" name="zip" id="zip" placeholder="{{ Lang::get('billers.placeholder.zip') }}" value="{{{ Input::old('zip', isset($biller) ? $biller->zip : null) }}}" />
                    {{ $errors->first('zip', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ zip -->
            </div>
            <div class="col-md-3">
                <!-- state -->
                <div class="form-group {{{ $errors->has('state') ? 'has-error' : '' }}}">
                    <label class="control-label" for="state">{{ Lang::get('billers.label.state') }}</label>
                    <input class="form-control" type="text" name="state" id="state" placeholder="{{ Lang::get('billers.placeholder.state') }}" value="{{{ Input::old('state', isset($biller) ? $biller->state : null) }}}" />
                    {{ $errors->first('state', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ state -->  
            </div>
            <div class="col-md-4">
                <!-- country -->
                <div class="form-group {{{ $errors->has('country_id') ? 'has-error' : '' }}}">
                    <label class="control-label" for="country_id">{{ Lang::get('general.country') }}</label>
                    @if (isset($biller))
                    <select class="form-control" name="country_id" id="country_id">
                        @foreach ($countries as $country)
                        <option {{ $biller->country_id == $country->id ? 'selected="selected"' : null }} value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>      
                    @else
                    <select class="form-control" name="country_id" id="country_id">
                        @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                    @endif      
                    {{ $errors->first('country_id', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ country --> 
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <!-- phone -->
                <div class="form-group {{{ $errors->has('phone') ? 'has-error' : '' }}}">
                    <label class="control-label" for="phone">{{ Lang::get('billers.label.phone') }}</label>
                    <input class="form-control" type="text" name="phone" id="phone" placeholder="{{ Lang::get('billers.placeholder.phone') }}" value="{{{ Input::old('phone', isset($biller) ? $biller->phone : null) }}}" />
                    {{ $errors->first('phone', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ phone -->
            </div>
            <div class="col-md-4">
                <!-- mobile -->
                <div class="form-group {{{ $errors->has('mobile') ? 'has-error' : '' }}}">
                    <label class="control-label" for="mobile">{{ Lang::get('billers.label.mobile') }}</label>
                    <input class="form-control" type="text" name="mobile" id="mobile" placeholder="{{ Lang::get('billers.placeholder.mobile') }}" value="{{{ Input::old('mobile', isset($biller) ? $biller->mobile : null) }}}" />
                    {{ $errors->first('mobile', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ mobile -->
            </div>
            <div class="col-md-4">
                <!-- fax -->
                <div class="form-group {{{ $errors->has('fax') ? 'has-error' : '' }}}">
                    <label class="control-label" for="fax">{{ Lang::get('billers.label.fax') }}</label>
                    <input class="form-control" type="text" name="fax" id="fax" placeholder="{{ Lang::get('billers.placeholder.fax') }}" value="{{{ Input::old('fax', isset($biller) ? $biller->fax : null) }}}" />
                    {{ $errors->first('fax', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ fax -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- email -->
                <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
                    <label class="control-label" for="email">{{ Lang::get('billers.label.email') }}</label>
                    <input class="form-control" type="text" name="email" id="email" placeholder="{{ Lang::get('billers.placeholder.email') }}" value="{{{ Input::old('email', isset($biller) ? $biller->email : null) }}}" />
                    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ email -->
            </div>
            <div class="col-md-6">
                <!-- web -->
                <div class="form-group {{{ $errors->has('web') ? 'has-error' : '' }}}">
                    <label class="control-label" for="web">{{ Lang::get('billers.label.web') }}</label>
                    <input class="form-control" type="text" name="web" id="web" placeholder="{{ Lang::get('billers.placeholder.web') }}" value="{{{ Input::old('web', isset($biller) ? $biller->web : null) }}}" />
                    {{ $errors->first('web', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ web -->
            </div>
        </div>

        <!-- form actions -->
        <div class="form-group">
            <div class="controls">
                <button type="submit" id="save" class="btn btn-success">{{ Lang::get('general.save') }}</button>
                <button type="reset" class="btn btn-default">{{ Lang::get('general.reset') }}</button>
                <a class="btn btn-link" href="{{{ URL::to('billers') }}}">{{ Lang::get('general.cancel') }}</a>
            </div>
        </div>
        <!-- ./ form actions --> 
    </div>
</div>