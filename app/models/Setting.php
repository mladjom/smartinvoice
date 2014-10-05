<?php

class Setting extends \Eloquent {

    // Add your validation rules here
    public static $rules = [
        'language' => 'required',
        'country_id' => 'required',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $fillable = [];
    protected $guarded = array();  // Important
    protected $table = 'settings';

    public function user() {
        return $this->belongsTo('User');
    }

}
