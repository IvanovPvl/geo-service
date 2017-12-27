<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 * @package App\Models
 * @property int $id
 * @property string $country
 * @property string $city
 * @property Block[] $blocks
 */
class Location extends Model
{
    /** @var bool */
    public $incrementing = false;

    /** @var bool */
    public $timestamps = false;

    /** @var array */
    public $hidden = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blocks()
    {
        return $this->hasMany(Block::class, 'geoname_id');
    }
}