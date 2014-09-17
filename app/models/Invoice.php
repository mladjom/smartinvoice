<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Invoice extends \Eloquent {

    use SoftDeletingTrait;

    // Add your validation rules here
    public static $rules = [
        'biller_id' => 'required',
        'client_id' => 'required',
        'number' => 'required',
    ];
    protected $fillable = ['id','name'];
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
	/**
	 * Deletes a invoice and all
	 * the associated items.
	 *
	 * @return bool
	 */
	public function delete()
	{
		// Delete the comments
		$this->item()->delete();

		// Delete the blog post
		return parent::delete();
	}
}
