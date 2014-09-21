<div class="row">
    <div class="col-md-3">
        <div class="form-group {{{ $errors->has('logo') ? 'has-error' : '' }}}">
            <label for="logo">{{ Lang::get('clients.label.logo') }}</label>
            <p class="help-block">{{ Lang::get('clients.help.logo') }}</p>
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new thumbnail" style="width: 240px; height: 80px;">
                    @if ( isset($client)  )
                    @if (  File::exists($client->image_path_thumbnail) )
                    {{ HTML::image($client->image_path_thumbnail, $client->image_name) }}
                    @endif
                    @else                        
                    <img class="img-responsive" src="http://placehold.it/240x80" alt="...">
                    @endif
                </div>
                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 240px; max-height: 80px;">
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
            <label class="control-label" for="name">{{ Lang::get('clients.label.name') }}</label>
            <input class="form-control" type="text" name="name" id="name" placeholder="{{ Lang::get('clients.placeholder.name') }}" value="{{{ Input::old('name', isset($client) ? $client->name : null) }}}" />
            {{ $errors->first('name', '<span class="help-block">:message</span>') }}
        </div>
        <!-- ./ name -->
        <div class="row">
            <div class="col-md-6">
                <!-- address_1 -->
                <div class="form-group {{{ $errors->has('address_1') ? 'has-error' : '' }}}">
                    <label class="control-label" for="address_1">{{ Lang::get('clients.label.address_1') }}</label>
                    <input class="form-control" type="text" name="address_1" id="address_1" placeholder="{{ Lang::get('clients.placeholder.address_1') }}" value="{{{ Input::old('address_1', isset($client) ? $client->address_1 : null) }}}" />
                    {{ $errors->first('address_1', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ address_1 -->
            </div>
            <div class="col-md-6">
                <!-- address_2 -->
                <div class="form-group {{{ $errors->has('address_2') ? 'has-error' : '' }}}">
                    <label class="control-label" for="address_2">{{ Lang::get('clients.label.address_2') }}</label>
                    <input class="form-control" type="text" name="address_2" id="address_2" placeholder="{{ Lang::get('clients.placeholder.address_2') }}" value="{{{ Input::old('address_2', isset($client) ? $client->address_2 : null) }}}" />
                    {{ $errors->first('address_2', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ address_2 -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <!-- city -->
                <div class="form-group {{{ $errors->has('city') ? 'has-error' : '' }}}">
                    <label class="control-label" for="city">{{ Lang::get('clients.label.city') }}</label>
                    <input class="form-control" type="text" name="city" id="city" placeholder="{{ Lang::get('clients.placeholder.city') }}" value="{{{ Input::old('city', isset($client) ? $client->city : null) }}}" />
                    {{ $errors->first('city', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ city -->  
            </div>
            <div class="col-md-2">
                <!-- zip -->
                <div class="form-group {{{ $errors->has('zip') ? 'has-error' : '' }}}">
                    <label class="control-label" for="zip">{{ Lang::get('clients.label.zip') }}</label>
                    <input class="form-control" type="text" name="zip" id="zip" placeholder="{{ Lang::get('clients.placeholder.zip') }}" value="{{{ Input::old('zip', isset($client) ? $client->zip : null) }}}" />
                    {{ $errors->first('zip', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ zip -->
            </div>
            <div class="col-md-3">
                <!-- state -->
                <div class="form-group {{{ $errors->has('state') ? 'has-error' : '' }}}">
                    <label class="control-label" for="state">{{ Lang::get('clients.label.state') }}</label>
                    <input class="form-control" type="text" name="state" id="state" placeholder="{{ Lang::get('clients.placeholder.state') }}" value="{{{ Input::old('state', isset($client) ? $client->state : null) }}}" />
                    {{ $errors->first('state', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ state -->  
            </div>
            <div class="col-md-4">
                <!-- country -->
                <div class="form-group {{{ $errors->has('country_id') ? 'has-error' : '' }}}">
                    <label class="control-label" for="country_id">{{ Lang::get('general.country') }}</label>
                    @if (isset($client))
                    <select class="form-control" name="country_id" id="country_id">
                        @foreach ($countries as $country)
                        <option {{ $client->country_id == $country->id ? 'selected="selected"' : null }} value="{{ $country->id }}">{{ $country->name }}</option>
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
                    <label class="control-label" for="phone">{{ Lang::get('clients.label.phone') }}</label>
                    <input class="form-control" type="text" name="phone" id="phone" placeholder="{{ Lang::get('clients.placeholder.phone') }}" value="{{{ Input::old('phone', isset($client) ? $client->phone : null) }}}" />
                    {{ $errors->first('phone', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ phone -->
            </div>
            <div class="col-md-4">
                <!-- mobile -->
                <div class="form-group {{{ $errors->has('mobile') ? 'has-error' : '' }}}">
                    <label class="control-label" for="mobile">{{ Lang::get('clients.label.mobile') }}</label>
                    <input class="form-control" type="text" name="mobile" id="mobile" placeholder="{{ Lang::get('clients.placeholder.mobile') }}" value="{{{ Input::old('mobile', isset($client) ? $client->mobile : null) }}}" />
                    {{ $errors->first('mobile', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ mobile -->
            </div>
            <div class="col-md-4">
                <!-- fax -->
                <div class="form-group {{{ $errors->has('fax') ? 'has-error' : '' }}}">
                    <label class="control-label" for="fax">{{ Lang::get('clients.label.fax') }}</label>
                    <input class="form-control" type="text" name="fax" id="fax" placeholder="{{ Lang::get('clients.placeholder.fax') }}" value="{{{ Input::old('fax', isset($client) ? $client->fax : null) }}}" />
                    {{ $errors->first('fax', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ fax -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- email -->
                <div class="form-group {{{ $errors->has('email') ? 'has-error' : '' }}}">
                    <label class="control-label" for="email">{{ Lang::get('clients.label.email') }}</label>
                    <input class="form-control" type="text" name="email" id="email" placeholder="{{ Lang::get('clients.placeholder.email') }}" value="{{{ Input::old('email', isset($client) ? $client->email : null) }}}" />
                    {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ email -->
            </div>
            <div class="col-md-6">
                <!-- web -->
                <div class="form-group {{{ $errors->has('web') ? 'has-error' : '' }}}">
                    <label class="control-label" for="web">{{ Lang::get('clients.label.web') }}</label>
                    <input class="form-control" type="text" name="web" id="web" placeholder="{{ Lang::get('clients.placeholder.web') }}" value="{{{ Input::old('web', isset($client) ? $client->web : null) }}}" />
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
                <a class="btn btn-link" href="{{{ URL::to('clients') }}}">{{ Lang::get('general.cancel') }}</a>
            </div>
        </div>
        <!-- ./ form actions --> 
    </div>
</div>