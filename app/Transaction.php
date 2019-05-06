<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transaction
 *
 * @package App
 * @property string $name
 * @property string $time_date
 * @property string $id_number
 * @property string $mac_adress
 * @property string $location
 * @property string $type
 * @property string $photo
*/
class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = ['time_date', 'mac_adress', 'location', 'type', 'photo', 'name_id', 'id_number_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setNameIdAttribute($input)
    {
        $this->attributes['name_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTimeDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['time_date'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['time_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getTimeDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setIdNumberIdAttribute($input)
    {
        $this->attributes['id_number_id'] = $input ? $input : null;
    }
    
    public function name()
    {
        return $this->belongsTo(User::class, 'name_id');
    }
    
    public function id_number()
    {
        return $this->belongsTo(User::class, 'id_number_id');
    }
    
}
