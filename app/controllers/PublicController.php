<?php

class PublicController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    public function showIndex() {
        return View::make('public.index');
    }

    public function about() {
        return View::make('public.about');
    }

    public function plans() {
        return View::make('public.plans');
    }

    public function features() {
        return View::make('public.features');
    }

}
