<div class="row">
    <div class="col-md-4">
        <!-- biller -->
        @if (count($billers) > 0)
        <div class="form-group {{{ $errors->has('biller_id') ? 'has-error' : '' }}}">
            <label class="control-label" for="biller_id">{{ Lang::get('general.biller') }}</label>
            @if (isset($invoice))
            <select class="form-control" name="biller_id" id="biller_id">
                @foreach ($billers as $biller)
                <option {{ $invoice->biller_id == $biller->id ? 'selected="selected"' : null }} value="{{ $biller->id }}">{{ $biller->name }}</option>
                @endforeach
            </select>      
            @else
            <select class="form-control" name="biller_id" id="biller_id">
                <option value="" selected disabled>{{ Lang::get('billers.general.select') }}</option>
                @foreach ($billers as $biller)
                <option value="{{ $biller->id }}">{{ $biller->name }}</option>
                @endforeach
            </select>
            @endif      
            {{ $errors->first('biller_id', '<span class="help-block">:message</span>') }}
        </div>
        <!-- ./ biller --> 
        @endif
    </div>
    <div class="col-md-4">
        <!-- client -->
        <div class="form-group {{{ $errors->has('client_id') ? 'has-error' : '' }}}">
            <label class="control-label" for="client_id">{{ Lang::get('general.client') }}</label>
            @if (isset($invoice))
            <select class="form-control" name="client_id" id="client_id">
                @foreach ($clients as $client)
                <option {{ $invoice->client_id == $client->id ? 'selected="selected"' : null }} value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>      
            @else
            <select class="form-control" name="client_id" id="client_id">
                <option value="" selected disabled>{{ Lang::get('clients.general.select') }}</option>
                @foreach ($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
            @endif      
            {{ $errors->first('client_id', '<span class="help-block">:message</span>') }}
        </div>
        <!-- ./ client --> 
    </div>
    <div class="col-md-4">
        <!-- design -->
        <div class="form-group {{{ $errors->has('design_id') ? 'has-error' : '' }}}">
            <label class="control-label" for="design_id">{{ Lang::get('general.design') }}</label>
        </div>
        <!-- ./ design --> 
    </div>
</div> 
<div id="pdf">
    <div class="row">
        <div class="col-xs-6 logo">

        </div>
        <div class="col-xs-6 text-right">
            <h1>INVOICE</h1>
            <h1><small>Invoice #001</small></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>{{ Lang::get('general.from') }}</strong>
                </div>
                <div class="panel-body ">
                    <address id="biller-info">
                    </address>
                </div>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>{{ Lang::get('general.to') }}</strong>
                </div>
                <div class="panel-body">
                    <address id="client-info">
                    </address>
                </div>
            </div>
        </div>
        <div class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>{{ Lang::get('general.details') }}</strong>
                </div>
                <div class="panel-body">
                    <!-- number -->
                    <div class="form-group {{{ $errors->has('number') ? 'has-error' : '' }}}">
                        <div class="row">
                            <label class="control-label col-sm-4" for="design_id">{{ Lang::get('invoices.label.number') }}</label>
                            <div class="col-sm-8">
                                <input class="form-control col-sm-8" type="text" name="number" id="number" placeholder="{{ Lang::get('invoices.placeholder.number') }}" value="{{{ Input::old('number', isset($invoice) ? $invoice->number : null) }}}" />
                                {{ $errors->first('number', '<span class="help-block">:message</span>') }}
                            </div>
                        </div>
                    </div>
                    <!-- ./ number -->
                    <!-- date -->
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-4" for="date">{{ Lang::get('invoices.label.date') }}</label>
                            <div class="col-sm-8">
                                <input class="datepicker form-control" name="date" id="date" data-date-format="yyyy-mm-dd" placeholder="{{ date('Y-m-d') }}" value="{{{ Input::old('date', isset($invoice) ? $invoice->date : null) }}}">
                            </div>
                        </div>
                    </div>
                    <!-- ./ date -->
                    <!-- due_date -->
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-4" for="due_date">{{ Lang::get('invoices.label.due_date') }}</label>
                            <div class="col-sm-8">
                                <input class="datepicker form-control" name="due_date" id="due_date" data-date-format="yyyy-mm-dd" placeholder="{{ date('Y-m-d', strtotime("+30 days")) }}" value="{{{ Input::old('due_date', isset($invoice) ? $invoice->due_date : null) }}}">
                            </div>
                        </div>
                    </div>
                    <!-- ./ due_date -->
                </div>
            </div>
        </div>    
    </div>
    <!-- / end client details section -->
    @include('invoices/items')
</div>
<!-- form actions -->
<div class="form-group">
    <div class="controls pull-right">
        <a class="btn btn-link" href="{{{ URL::to('clients') }}}">{{ Lang::get('general.cancel') }}</a>
        <button type="submit" id="save" class="btn btn-success btn-lg">{{ Lang::get('general.save') }}</button>
    </div>
</div>
<!-- ./ form actions -->
@include('invoices/assets')
