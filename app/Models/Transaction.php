<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Transaction
 * @package App\Models
 *
 * @property int                                $id
 * @property int                                $webservice_id
 * @property int                                $amount
 * @property int                                $type
 * @property \Illuminate\Support\Carbon|null    $created_at
 * @property \Illuminate\Support\Carbon|null    $updated_at
 * @property-read WebService                    $webService
 */
class Transaction extends Model
{
    use HasFactory;


    /** @var array $fillable */
    protected $fillable = [
        'webservice_id',
        'amount',
        'type',
        'created_at'
    ];


    /**
     * @var string[]
     */
    protected $casts = [
        'amount'    => 'int',
        'type'    => 'int',

        'webservice_id'              => 'int',
    ];


    /**
     * @return BelongsTo
     */
    public function webService(): BelongsTo
    {
        return $this->belongsTo(WebService::class, 'webservice_id', 'id');
    }

}
