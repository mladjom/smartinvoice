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
        <!-- client -->
        <div class="form-group {{{ $errors->has('client_id') ? 'has-error' : '' }}}">
            <label class="control-label" for="client_id">{{ Lang::get('general.design') }}</label>
            @if (isset($invoice))
            <select class="form-control" name="client_id" id="client_id">
                @foreach ($clients as $client)
                <option {{ $invoice->client_id == $client->id ? 'selected="selected"' : null }} value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>      
            @else
            <select class="form-control" name="client_id" id="client_id">
                @foreach ($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
            @endif      
            {{ $errors->first('client_id', '<span class="help-block">:message</span>') }}
        </div>
        <!-- ./ client --> 
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
                    <input class="form-control" type="text" name="number" id="number" placeholder="{{ Lang::get('invoices.placeholder.number') }}" value="{{{ Input::old('number', isset($invoice) ? $invoice->number : null) }}}" />
                    {{ $errors->first('number', '<span class="help-block">:message</span>') }}
                </div>
                <!-- ./ number -->
                <input class="datepicker form-control" data-date-format="mm/dd/yyyy">
            </div>
        </div>
    </div>    
</div>
<!-- / end client details section -->
<!-- Start row 3 -->
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="items" class="table table-bordered">
                <tr class="invoice-items-th">
                    <th width="25%">{{ Lang::get('general.item') }}</th>
                    <th width="40%">{{ Lang::get('general.description') }}</th>
                    <th width="15%">{{ Lang::get('general.price') }}</th>
                    <th width="10%">{{ Lang::get('general.qty') }}Qty</th>
                    <th width="15%" align="right"><span class="pull-right">{{ Lang::get('general.total') }}</span></th>
                </tr> 
                <tr class="item-row">
                    <td class="item-name">
                        <div class="delete-wpr">
                            <input type="text" class="form-control item-name" value="" placeholder="Item name" name="item_name[]">
                            <a class="delete btn btn-danger" title="Remove row"><i class="fa fa-remove"></i></a>
                        </div>
                    </td>
                    <td class="description">
                        <textarea class="form-control" rows="1" placeholder="Item description" name="item_description[]" id="itemDescription"></textarea>
                    </td>
                    <td>
                        <input type="text" class="cost form-control" placeholder="0.00" name="item_price[]" id="itemPrice">
                    </td>
                    <td><input type="text" class="qty form-control" value="" placeholder="0" name="item_qty[]" id="itemQty"></td>
                    <td align="right"><span class="price">0.00</span></td>
                </tr>

                <tr id="hiderow">
                    <td colspan="5"><a id="addrow" class="btn btn-success" title="Add a row"><span class="glyphicon glyphicon-plus-sign"></span> Add line</a></td>
                </tr>

                <tr>
                    <td colspan="2" class="blank"> </td>
                    <td colspan="2" class="total-line" align="right">{{ Lang::get('general.subtotal') }}</td>
                    <td class="total-value" align="right"><div id="subtotal">0.00</div></td>
                </tr>

                <tr>
                    <td colspan="2" class="blank"> </td>
                    <td colspan="2" class="total-line" align="right">

                        <span>{{ Lang::get('general.tax') }}</span>
                        @if (count($tax_rates ) > 0)
                        @if (isset($invoice))
                        <select class="form-control" name="tax_rate" id="tax_rate">
                            @foreach ($tax_rates as $rate)
                            <option {{ $invoice->client_id == $client->id ? 'selected="selected"' : null }} value="{{ $client->id }}">{{ $client->name }}</option>
                            @endforeach
                        </select>      
                        @else
                        <select class="form-control" name="tax_rate" id="tax_rate">
                            @foreach ($tax_rates as $tax_rates)
                            <option value="{{ $tax_rates->id }}" data-rate="{{ $tax_rates->tax_total }}">{{ $tax_rates->name }}</option>
                            @endforeach
                        </select>
                        @endif      
                        {{ $errors->first('tax_rate', '<span class="help-block">:message</span>') }}
                        @else
                        <a href="#" class="btn btn-link">Manage Taxes</a>
                        @endif

                    </td> 
                    <td class="total-value" align="right">
                        <div id="taxtotal">0.00</div>
                        <input type="hidden" id="invoice_total_tax" name="invoice_total_tax" value="">
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="blank"> </td>
                    <td colspan="2" class="total-line" align="right">Total &euro;:</td>
                    <td class="total-value" align="right"><div id="total">0.00</div></td>
                </tr>

                <tr>
                    <td colspan="2" class="blank"> </td>
                    <td colspan="2" class="total-line" align="right" style="line-height:35px;">Total Paid &euro;:</td>
                    <td class="total-value"> 
                        <div style="margin-right:-5px;">

                            <input type="text" id="paid" class="form-control text-align-right" placeholder="0.00" name="invoice_total_paid">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="blank"> </td>
                    <td colspan="2" class="total-line balance" align="right"><font class="invoice-total">Total Due &euro;:</font></td>
                    <td class="total-value balance" align="right"><h2><div class="due">0.00</div></h2></td>
                </tr>

            </table>
        </div>

        <h4>Invoice notes</h4>
        <hr>
        <div class="col-md-12">
            <textarea class="form-control" name="invoice_note" rows="3">Total amount should be paid within 14 working days from invoice date. </textarea>
        </div>

    </div>

</div> <!-- End row 3 -->

<div class="row">
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
</div>
<div class="row">
    <div class="col-md-3">

    </div>
    <div class="col-md-3">

    </div>
    <div class="col-md-3">

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
@section('scripts')
{{ HTML::script('assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.js'); }}
{{ HTML::script('assets/js/calc.js'); }}
<script type="text/javascript">
                $(".delete").hide();

    $(document).ready(function() {
        $('.datepicker').datepicker();
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
    $("#paid").blur(update_balance);
    $("#tax_rate").change(update_total);

    // Add new items row to invoice
    // If you like to change your HTML for your invoice item, do so below, make sure you keep the right classes
    $("#addrow").click(function() {
        $(".item-row:last").after('<tr class="item-row"><td class="item-name"><div class="delete-wpr"><input type="text" class="form-control item-name" placeholder="Item name" name="item_name[]" value=""><a class="delete btn btn-danger"  title="Remove row"><i class="fa fa-remove"></i></span></a></div></td><td class="description"><textarea class="form-control" name="item_description[]" rows="1" placeholder="Item description" id="itemDescription"></textarea></td><td><input type="text" class="cost form-control" name="item_price[]" id="itemPrice" placeholder="0.00"></td><td><input type="text" class="qty form-control" value="" name="item_qty[]" placeholder="0" id="itemQty"></td><td align="right"><span class="price">$0.00</span></td></tr>');
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