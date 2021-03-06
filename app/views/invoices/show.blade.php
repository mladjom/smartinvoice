@extends('layouts.master')

@section('title') {{ Lang::get('general.invoice') }} :: {{ $invoice->number }} @parent @stop

@section('content') 
<div class="page-header clearfix">
    <div class="pull-right">
        <a href="{{{ URL::to('invoices/' . $invoice->id. '/download') }}}" class="btn btn-default download-pdf"><i class="fa fa-download"></i> {{ Lang::get('general.pdf') }}</a>
        <a href="{{{ URL::to('invoices') }}}" class="btn btn-default"><i class="fa fa-mail-reply"></i> {{ Lang::get('general.back') }}</a>
    </div>
</div>
<div id="pdf">
    <div class="page-header clearfix">
        <div class="col-xs-6 logo">
            {{$logo}}
        </div>
        <div class="col-xs-6 text-right">
            <h1><small>Invoice# {{$invoice->number}}</small></h1>
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
                        {{$biller}}
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
                        {{$client}}
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
    <div class="table-responsive">
        <table id="items" class="table table-bordered">
            <thead>
                <tr class="invoice-items-th">
                    <th class="col-xs-3">{{ Lang::get('general.item') }}</th>
                    <th class="col-xs-6">{{ Lang::get('general.description') }}</th>
                    <th class="col-xs-1">{{ Lang::get('general.price') }}</th>
                    <th class="col-xs-1">{{ Lang::get('general.qty') }}</th>
                    <th class="text-right col-xs-1">{{ Lang::get('general.total') }}</th>
                </tr> 
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr class="item-row">
                    <td class="item-name col-xs-3">
                        {{$item->name}}
                    </td>
                    <td class="description col-xs-6">
                        {{$item->description}}
                    </td>
                    <td class="col-xs-1">
                        {{$item->price}}
                    </td>
                    <td class="col-xs-1">
                        {{$item->quantity}}                        
                    </td>
                    <td class="col-xs-1 text-right">
                        <span class="item_total">{{$item->total}}</span>
                    </td>
                </tr>
                @endforeach 
                <tr class="text-right">
                    <td colspan="4" class="total-line">{{ Lang::get('general.subtotal') }}</td>
                    <td class="total-value">
                        <div class="subtotal">{{{ $invoice->subtotal }}}</div>
                    </td>
                </tr>
                <tr class="text-right">
                    <td colspan="4" class="total-line text-right">
                        {{ Lang::get('general.tax') }} {{ $tax_rate }}
                    </td> 
                    <td class="total-value">
                        <div id="taxtotal">{{{ $invoice->tax_total }}}</div>
                    </td>
                </tr>
                <tr class="text-right">
                    <td colspan="4" class="total-line">{{ Lang::get('general.total') }}</td>
                    <td class="total-value">
                        <div id="total">{{{ $invoice->total }}}</div>
                    </td>
                </tr>
                <tr class="text-right">
                    <td colspan="4" class="total-line">{{ Lang::get('general.total_paid') }}</td>
                    <td class="total-value"> 
                        <div>
                            {{{ $invoice->paid }}}
                        </div>
                    </td>
                </tr>
                <tr class="text-right">
                    <td colspan="2" class="blank"> </td>
                    <td colspan="2" class="total-line balance"><span class="invoice-total">{{ Lang::get('general.total_due') }}</span></td>
                    <td class="total-value balance">
                        <h2 class="due">{{{ $invoice->balance }}}</h2>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <h4>Invoice notes</h4>
    <hr>
    <div>
        <textarea class="form-control" name="note" rows="3">Total amount should be paid within 14 working days from invoice date. </textarea>
    </div>
</div>
@stop