<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class WebService
 * @package App\Models
 * @property int         $id
 * @property string      $name
 */
class WebService extends Model
{
    use HasFactory;


    /**
     * @var string[]
     */
    protected $fillable = [
        'name'
    ];

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'webservice_id', 'id');
    }

}
