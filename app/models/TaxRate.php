<?php

class TaxRate extends \Eloquent {

    protected $fillable = [];
    protected $guarded = array();  // Important

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tax_rates';

    public function item() {
        return $this->hasMany('Item');
    }
    
    public function invoice() {
        return $this->hasMany('Invoice');
    }
    
    public function user() {
        return $this->belongsTo('User');
    }

}
