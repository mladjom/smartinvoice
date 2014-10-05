<?php

class Country extends \Eloquent {
    
    protected $table = 'countries';
    
    protected $visible = ['id', 'name'];
    
    public function biller() {
        return $this->hasMany('Biller');
    }
    public function client() {
        return $this->hasMany('Client');
    }    
}