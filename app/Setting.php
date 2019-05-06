<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Setting
 *
 * @package App
 * @property string $compant_name
 * @property string $website
 * @property string $address
 * @property string $logo
*/
class Setting extends Model
{
    use SoftDeletes;

    protected $fillable = ['compant_name', 'website', 'address', 'logo'];
    protected $hidden = [];
    
    
    
}
