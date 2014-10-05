@extends('layouts.master')

@section('title') {{ Lang::get('general.dashboard') }} :: @parent @stop

@section('styles') 
{{ HTML::style('assets/lib/bootstrap-tour/css/bootstrap-tour.min.css'); }}
@stop

@section('content')
<div class="page-header">
    <h2>{{ Lang::get('general.dashboard') }}</h2>
</div> 
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">26</div>
                        <div>New Comments!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">12</div>
                        <div>New Tasks!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">124</div>
                        <div>New Orders!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">13</div>
                        <div>Support Tickets!</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

@stop

@section('scripts')
{{ HTML::script('assets/lib/bootstrap-tour/js/bootstrap-tour.min.js'); }}
<script type="text/javascript" language="javascript">
    $(document).ready(function () {


        // Instance the tour
        var tour = new Tour({
            name: "initialTour",
            container: "body",
            keyboard: true,
            storage: window.localStorage,
            debug: false,
            backdrop: false,
            redirect: true,
            duration: false,
            template: "<div class='popover'> <div class='arrow'></div><h3 class='popover-title'></h3> <div class='popover-content'></div> <div class='popover-navigation'> <div class='btn-group'> <button class='btn btn-sm btn-success' data-role='prev'>&laquo; Prev</button> <button class='btn btn-sm btn-success' data-role='next'>Next &raquo;</button> <button class='btn btn-sm btn-success' data-role='pause-resume' data-pause-text='Pause' data-resume-text='Resume'>Pause</button> </div> <button class='btn btn-sm btn-success' data-role='end'>End tour</button> </div> </div>",
            onStart: function(tour) {
            }
        });

        tour.addSteps([
            {
                title: "Welcome to SmartInvoice!",
                content: "This guide tour will help you through the software and how you create and manage your resources.",
                orphan: true
            },

        ]);

        tour.init();
        tour.start();

    });
</script>
@stop