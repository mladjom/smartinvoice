<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Invoice extends AbstractModel {

    use SoftDeletingTrait;

    // Add your validation rules here
    public static $rules = [
        'biller_id' => 'required',
        'client_id' => 'required',
        'number' => 'required',
    ];
    protected $fillable = [];
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
        return $this->hasMany('Item')->withTrashed();
    }

    public function tax_rate() {
        return $this->belongsTo('TaxRate');
    }

    /**
     * Deletes a invoice and all
     * the associated items.
     *
     * @return bool
     */
    public function delete() {
        // Delete the items
        $this->item()->delete();

        // Delete the invoice
        return parent::delete();
    }

    public function address($a) {

        $lines = array();
         if (isset($a['name']) && $a['name'])
            $lines[] = '<strong>'.$a['name'].'</strong>';
         if (isset($a['address_1']) && $a['address_1'])
            $lines[] = $a['address_1'];
        if (isset($a['address2']) && $a['address2'])
            $lines[] = $a['address2'];
        if ((isset($a['city']) && $a['city']) || (isset($a['state']) && $a['state']) || (isset($a['zip']) && $a['zip'])) {
            $line = array();
            if (isset($a['city']) && $a['city'])
                $line[] = $a['city'];
            if (isset($a['state']) && $a['state'])
                $line[] = $a['state'];
            if (isset($a['zip']) && $a['zip'])
                $line[] = $a['zip'];
            $lines[] = implode(' ', $line);
        }
         if (isset($a['country_id']) && $a['country_id'])
            $lines[] = Country::where('id', $a['country_id'])->pluck('name');; 
         if (isset($a['phone']) && $a['phone'])
            $lines[] = $a['phone'];        
         if (isset($a['email']) && $a['email'])
            $lines[] = $a['email'];       
          if (isset($a['web']) && $a['web'])
            $lines[] = $a['web'];       
        
        $lines = join('<br>', $lines);;
        return $lines;
    }

  public function logo($a) {

        $lines = array();
         if (isset($a['image_path_thimbnail']) && $a['image_path_thimbnail']){
            $lines[] = '<img src="'.$a['image_path_thimbnail'].'">';
         }else {
              $lines[] = '<h1>'.$a['name'].'</h1>';
         }
        
        $lines = join('<br>', $lines);;
        return $lines;
    }  
    
    
    
}
