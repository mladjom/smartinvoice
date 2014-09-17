<?php

class Item extends \Eloquent {

    protected $fillable = ['id', 'invoice_id'];
    protected $guarded = array();
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';
    
    public function invoice() {
        return $this->belongsTo('Invoice');
    }

    public function tax_rates() {
        return $this->belongsTo('TaxRate');
    }

}
