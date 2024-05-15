<?php

namespace PalauaAndSons\CloudflareGeoIp\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \PalauaAndSons\CloudflareGeoIp\Location getLocation()
 *
 * @see \PalauaAndSons\CloudflareGeoIp\GeoIp
 */
class GeoIp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cloudflare-geoip';
    }
}
