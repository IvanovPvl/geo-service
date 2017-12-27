<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Block
 * @package App\Models
 * @property int $id
 * @property string $network
 * @property int $geoname_id
 * @property double $latitude
 * @property double $longitude
 * @property Location $location
 */
class Block extends Model
{
    /** @var bool */
    public $timestamps = false;

    /** @var array */
    public $hidden = ['id', 'network', 'geoname_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'geoname_id');
    }

    /**
     * @param string $ip
     *
     * @return mixed
     */
    public static function get(string $ip)
    {
        return Cache::remember($ip, env('CACHE_TTL', 30), function () use ($ip) {
            $where = sprintf("inet '%s' <<= network", $ip);
            return self::with('location')
                ->whereRaw($where)
                ->firstOrFail();
        });
    }
}