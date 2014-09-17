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
                @if (isset($invoice) || isset($items))
                @foreach ($items as $item)
                <tr class="item-row">
                <input type="hidden" name="item_id[]" value="{{$item->id}}">
                <td class="item-name">
                    <div class="delete-wpr">
                        <input type="text" class="form-control item-name" value="{{$item->name}}" placeholder="Item name" name="item_name[]">
                        <a class="delete btn btn-danger" title="Remove row"><i class="fa fa-remove"></i></a>
                    </div>
                </td>
                <td class="description">
                    <textarea class="form-control" rows="1" placeholder="Item description" name="item_description[]" id="itemDescription">{{$item->description}}</textarea>
                </td>
                <td>
                    <input type="text" class="cost form-control" value="{{$item->price}}" placeholder="0.00" name="item_price[]" id="itemPrice">
                </td>
                <td><input type="text" class="qty form-control" value="{{$item->quantity}}" placeholder="0" name="item_qty[]" id="itemQty"></td>
                <td align="right"><span class="price">0.00</span></td>
                </tr>
                @endforeach 
                @else
                <tr class="item-row">
                <input type="hidden" name="item_id[]" value="">
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
                @endif

                <tr id="hiderow">
                    <td colspan="5"><a id="addrow" class="btn btn-default" title="Add a row"><span class="glyphicon glyphicon-plus-sign"></span> Add line</a></td>
                </tr>
                <tr>
                    <td colspan="2" class="blank"> </td>
                    <td colspan="2" class="total-line" align="right">{{ Lang::get('general.subtotal') }}</td>
                    <td class="total-value" align="right"><div id="subtotal">0.00</div></td>
                </tr>

                <tr>
                    <td colspan="2" class="blank"> {{ Lang::get('general.tax') }}</td>
                    <td colspan="2" class="total-line" align="right">
                        @if (count($tax_rates ) > 0)
                        @if (isset($invoice))
                        <select class="form-control" name="tax_rate" id="tax_rate">
                            <option value="" data-rate="0">{{ Lang::get('general.tax') }}</option>
                            @foreach ($tax_rates as $rate)
                            <option {{ $invoice->tax_rate_id == $rate->id ? 'selected="selected"' : null }} value="{{ $rate->id }}" data-rate="{{ $rate->tax_total }}">{{ $rate->name }}</option>
                            @endforeach
                        </select>      
                        @else
                        <select class="form-control" name="tax_rate" id="tax_rate">
                            <option value="" data-rate="0" selected>{{ Lang::get('general.tax') }}</option>
                            @foreach ($tax_rates as $rate)
                            <option value="{{ $rate->id }}" data-rate="{{ $rate->tax_total }}">{{ $rate->name }}</option>
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
                    <td colspan="2" class="total-line" align="right">Total</td>
                    <td class="total-value" align="right"><div id="total">0.00</div></td>
                </tr>

                <tr>
                    <td colspan="2" class="blank"> </td>
                    <td colspan="2" class="total-line" align="right" style="line-height:35px;">Total Paid</td>
                    <td class="total-value"> 
                        <div style="margin-right:-5px;">

                            <input type="text" id="paid" class="form-control text-align-right" placeholder="0.00" name="invoice_total_paid">
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="blank"> </td>
                    <td colspan="2" class="total-line balance" align="right"><font class="invoice-total">Total Due</font></td>
                    <td class="total-value balance" align="right"><h2><div class="due">0.00</div></h2></td>
                </tr>

            </table>
        </div>

        <h4>Invoice notes</h4>
        <hr>
        <div class="form-group {{{ $errors->has('note') ? 'has-error' : '' }}}">
            <textarea class="form-control" name="note" rows="3">Total amount should be paid within 14 working days from invoice date. </textarea>
        </div>

    </div>

</div>