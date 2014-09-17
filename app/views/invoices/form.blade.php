@section('styles') 
{{ HTML::style('assets/lib/bootstrap-datepicker/css/datepicker3.css'); }}
@stop
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


<!--<div class="row">
    <div class="col-xs-5">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4>Bank details</h4>
            </div>
            <div class="panel-body">
                <p>Your Name</p>
                <p>Bank Name</p>
                <p>SWIFT : --------</p>
                <p>Account Number : --------</p>
                <p>IBAN : --------</p>
            </div>
        </div>
    </div>
    <div class="col-xs-7">
        <div class="span7">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Contact Details</h4>
                </div>
                <div class="panel-body">
                    <p>
                        Email : you@example.com <br><br>
                        Mobile : -------- <br> <br>
                        Twitter : <a href="https://twitter.com/tahirtaous">@TahirTaous</a>
                    </p>
                    <h4>Payment should be made by Bank Transfer</h4>
                </div>
            </div>
        </div>
    </div>
</div>-->

<!-- form actions -->
<div class="form-group">
    <div class="controls pull-right">
        <a class="btn btn-link" href="{{{ URL::to('clients') }}}">{{ Lang::get('general.cancel') }}</a>
        <button type="submit" id="save" class="btn btn-success btn-lg">{{ Lang::get('general.save') }}</button>
    </div>
</div>
<!-- ./ form actions -->
@section('scripts')
{{ HTML::script('assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.js'); }}
{{ HTML::script('assets/js/calc.js'); }}
<script type="text/javascript">
    $(document).ready(function() {
        @if (isset($invoice))
            var client_id = $('#client_id option:selected').val();
            $.get("{{ URL::to('clients/') }}/" + client_id, function(data) {
                if (data.status === "success") {
                    $("#client-info").append(address(data));
                }
            });
            var biller_id = $('#biller_id option:selected').val();
            $.get("{{ URL::to('billers/') }}/" + biller_id, function(data) {
                if (data.status === "success") {
                    $("#biller-info").append(address(data));
                    $(".logo").append(logo(data));
                }
            });

        @endif 
        if ($(".delete").length > 1){
            $(".delete").show()
        } 
        else {
            $(".delete").hide();
        }       
        $('.datepicker').datepicker({
            clearBtn: true,
        })
        $('#biller_id').on('change', function(e) {
            var id = $('#biller_id').val();
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: "{{ URL::to('billers/') }}/" + id,
                success: function(data) {
                    // Check for a valid server side response
                    if (data.status === "success") {
                        $("#biller-info").empty();
                        console.log(logo(data));
                        $("#biller-info").append(address(data));
                        $(".logo").append(logo(data));
                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    alert("Something went wrong. Please Try again later...");
                }
            });
        });
        $('#client_id').on('change', function(e) {
            var id = $('#client_id').val();
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: "{{ URL::to('clients/') }}/" + id,
                success: function(data) {
                    console.log(data);
                    // Check for a valid server side response
                    if (data.status === "success") {
                        $("#client-info").empty();
                        $("#client-info").append(address(data));
                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    alert("Something went wrong. Please Try again later...");
                }
            });
        });

        $('input').click(function() {
            $(this).select();
        });

        $("#number").blur(function() {

            console.log($(this).val());
        });

        $("#paid").blur(update_balance);
        $("#tax_rate").change(update_total);

        // Add new items row to invoice
        $("#addrow").click(function() {
            $(".item-row:last").after('<tr class="item-row"><input type="hidden" name="item_id[]" value=""><td class="item-name"><div class="delete-wpr"><input type="text" class="form-control item-name" placeholder="Item name" name="item_name[]" value=""><a class="delete btn btn-danger"  title="Remove row"><i class="fa fa-remove"></i></span></a></div></td><td class="description"><textarea class="form-control" name="item_description[]" rows="1" placeholder="Item description" id="itemDescription"></textarea></td><td><input type="text" class="cost form-control" name="item_price[]" id="itemPrice" placeholder="0.00"></td><td><input type="text" class="qty form-control" value="" name="item_qty[]" placeholder="0" id="itemQty"></td><td align="right"><span class="price">$0.00</span></td></tr>');
            if ($(".delete").length > 0)
                $(".delete").show();
            bind();
        });

        bind();

        $(document).on("click", "a.delete", function() {
            $(this).parents('.item-row').remove();
            update_total();
            if ($(".delete").length < 2)
                $(".delete").hide();
        });
    });
</script>
@stop