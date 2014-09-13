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
        return $this->belongsTo('Item');
    }

    public function user() {
        return $this->belongsTo('User');
    }

}
