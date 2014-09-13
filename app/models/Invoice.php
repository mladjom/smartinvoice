<?php

class Invoice extends \Eloquent {

    use SoftDeletingTrait;

    // Add your validation rules here
    public static $rules = [
    ];
    protected $guarded = array();  // Important
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoices';

    public function user() {
        return $this->belongsTo('User');
    }

    public function client() {
        return $this->belongsTo('Client')->withTrashed();
    }

    public function biller() {
        return $this->belongsTo('Biller')->withTrashed();
    }

    public function item() {
        return $this->hasMany('Item');
    }

}
