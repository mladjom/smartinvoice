<?php
use Zizaco\Confide\ConfideValidator;
use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\ConfideUserInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements ConfideUserInterface {

    use ConfideUser;

use HasRole;

    public function setting() {
        return $this->hasOne('Setting');
    }

    public function biller() {
        return $this->hasMany('Biller');
    }

    public function client() {
        return $this->hasMany('Client');
    }

    public function invoice() {
        return $this->hasMany('Invoice');
    }

    public function tax_rate() {
        return $this->hasMany('TaxRate');
    }

}