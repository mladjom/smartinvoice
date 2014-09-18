@extends('layouts.modal')

@section('title') {{ Lang::get('general.invoice') }} :: {{ $invoice->number }} @parent @stop

@section('content') 
<div class="row">
    <div class="col-md-12">
        <div class="page-header clearfix">
            <div class="pull-right">
                <a href="{{{ URL::to('invoices/' . $invoice->id. '/download') }}}" class="btn btn-primary download-pdf"><i class="fa fa-download"></i> {{ Lang::get('general.pdf') }}</a>
            </div>
        </div>
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
                    <div class="row">
                        <div class="control-label col-sm-4">
                            <p><strong>{{ Lang::get('invoices.label.number') }}</strong></p>
                        </div>
                        <div class="col-sm-8 text-right">
                            <p>{{$invoice->number}}</p>
                        </div>
                    </div>
                    <!-- ./ number -->
                    <!-- date -->
                    <div class="row">
                        <div class="control-label col-sm-4">
                            <p><strong>{{ Lang::get('invoices.label.date') }}</strong></p>
                        </div>
                        <div class="col-sm-8 text-right">
                            <p>{{$invoice->date}}</p>
                        </div>
                    </div>
                    <!-- ./ date -->
                    <!-- due_date -->
                    <div class="row">
                        <div class="control-label col-sm-4">
                            <p><strong>{{ Lang::get('invoices.label.due_date') }}</strong></p>
                        </div>
                        <div class="col-sm-8 text-right">
                            <p>{{$invoice->due_date}}</p>
                        </div>
                    </div>
                    <!-- ./ due_date -->
                </div>
            </div>
        </div>    
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="items" class="table table-bordered">
                    <tr class="invoice-items-th">
                        <th width="25%">{{ Lang::get('general.item') }}</th>
                        <th width="40%">{{ Lang::get('general.description') }}</th>
                        <th width="15%">{{ Lang::get('general.price') }}</th>
                        <th width="10%">{{ Lang::get('general.qty') }}</th>
                        <th width="15%" align="right"><span class="pull-right">{{ Lang::get('general.total') }}</span></th>
                    </tr> 
                    @foreach ($items as $item)
                    <tr class="item-row">
                        <td class="item-name">
                            {{$item->name}}
                        </td>
                        <td class="description">
                            {{$item->description}}
                        </td>
                        <td>
                            {{$item->price}}
                        </td>
                        <td>
                            {{$item->quantity}}                        
                        </td>
                        <td align="right">
                            <span class="item_total">{{$item->total}}</span>
                        </td>
                    </tr>
                    @endforeach 
                    <tr id="hiderow">
                        <td colspan="5"></td>
                    </tr>
                    <tr class="text-right">
                        <td colspan="2" class="blank"> </td>
                        <td colspan="2" class="total-line">{{ Lang::get('general.subtotal') }}</td>
                        <td class="total-value">
                            <div class="subtotal">{{{ $invoice->subtotal }}}</div>
                        </td>
                    </tr>
                   <tr class="text-right">
                        <td colspan="2" class="blank"> </td>
                        <td colspan="2" class="total-line text-right">
                            {{ Lang::get('general.tax') }} {{ $invoice->tax_rate_id }}
                        </td> 
                        <td class="total-value">
                            <div id="taxtotal">{{{ $invoice->tax_total }}}</div>
                        </td>
                    </tr>
                    <tr class="text-right">
                        <td colspan="2" class="blank"> </td>
                        <td colspan="2" class="total-line">{{ Lang::get('general.total') }}</td>
                        <td class="total-value">
                            <div id="total">{{{ $invoice->total }}}</div>
                        </td>
                    </tr>

                    <tr class="text-right">
                        <td colspan="2" class="blank"> </td>
                        <td colspan="2" class="total-line">{{ Lang::get('general.total_paid') }}</td>
                        <td class="total-value"> 
                            <div>
                                {{{ $invoice->paid }}}
                            </div>
                        </td>
                    </tr>
                    <tr class="text-right">
                        <td colspan="2" class="blank"> </td>
                        <td colspan="2" class="total-line balance"><font class="invoice-total">{{ Lang::get('general.total_due') }}</font></td>
                        <td class="total-value balance">
                            <h2><div class="due">{{{ $invoice->balance }}}</div></h2>
                        </td>
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
</div>
@stop