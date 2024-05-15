# Cloudflare GeoIp for Laravel.

Get the geographical localtion of visitor based off Cloudflare headers.

> [!CAUTION]
> Make sure [Visitor Location](https://developers.cloudflare.com/rules/transform/managed-transforms/reference/#add-visitor-location-headers) & [IP Geolocation](https://developers.cloudflare.com/network/ip-geolocation/#add-ip-geolocation-information) are enabled in Cloudflare Dashboard.

### Installation

```sh
composer require palauaandsons/cloudflare-geoip
```

#### Configuration

Run the following command to publish configuration. Be sure to modify the configuration file specifically the default location to use if the cloudflare headers are absent.

```sh
php artisan vendor:publish --tag=cloudflare-geoip-config
```

#### Usage

```php
<?php

namespace App\Http\Controllers;

use PalauaAndSons\CloudflareGeoIp\Facades\GeoIp;
use App\Models\Users;

class RegisterController extends Controller {
    public function __invoke(): User
    {
        $location = GeoIp::getLocation();

        return User::create([
            'register_ip' => $location->ip
        ]);
    }
}
```

#### Location Object

```php
\PalauaAndSons\CloudflareGeoIp\Location {
    +ip: "192.182.88.29"
    +city: "New Haven"
    +country: "US"
    +continent: "NA"
    +latitude: 41.31
    +longitude: -72.92
    +postalCode: "06510"
    +region: "Connecticut"
    +regionCode: "CT"
    +timezone: "America/New_York"
    // pseudo fields
    +iso_code: 'US' // same as country
    +isoCode: 'US' // same as country
    +state: 'CT' // same as regionCode
    +state_name: 'Connecticut' // same as region
    +stateName: 'Connecticut' // same as region
    +postal_code: '06510' // same as postal_code
    +lat: '41.31' // same as latitude
    +lon: -72.92 // same as longitude

    +toArray(): array
}
```
