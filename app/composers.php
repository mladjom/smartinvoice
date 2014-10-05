<?php

// Billers form
View::composer('billers/form', function($view) {
    
    $view->with('countries', Country::all());
    
});
// Clients form
View::composer('clients/form', function($view) {
    
    $view->with('countries', Country::all());
    
});
