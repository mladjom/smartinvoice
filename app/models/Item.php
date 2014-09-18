<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Item extends \Eloquent {
   
    use SoftDeletingTrait;

    protected $fillable = [];
    protected $guarded = array();
    protected $dates = ['deleted_at'];
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
