<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Biller extends AbstractModel {

    use SoftDeletingTrait;

    // Add your validation rules here
    public static $rules = [
        'name' => 'required',
        'logo' => 'image|max:2000',
        'email' => 'required|email',
        'web' => 'url',
    ];
    protected $guarded = array();  // Important
    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'billers';

    public function user() {
        return $this->belongsTo('User');
    }

    public function country() {
        return $this->belongsTo('Country');
    }

    public function invoice() {
        return $this->hasMany('Invoice');
    }
   /**
* Determine if the passed User is the Snippet author
*
* @param User $user User instance
* @return boolean
*/
public function isTheAuthor($user)
{
return $this->user_id === $user->id;
}     
}
