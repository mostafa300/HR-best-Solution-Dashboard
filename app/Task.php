<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Task
 *
 * @package App
 * @property string $name
 * @property string $description
 * @property string $from
 * @property string $deadline
*/
class Task extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'deadline', 'from_id'];
    protected $hidden = [];
    
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setFromIdAttribute($input)
    {
        $this->attributes['from_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDeadlineAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['deadline'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['deadline'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDeadlineAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
    
    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
    
    public function to()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }
    
}
