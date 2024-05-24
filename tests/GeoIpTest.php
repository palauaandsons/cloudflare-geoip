<?php

use PalauaAndSons\CloudflareGeoIp\Facades\GeoIp;

test('uses headers to fill location properties', function (string $headerName, string $propertyName, mixed $value) {
    $this->withHeaders([
        $headerName        => $value,
        'Cf-Ipcountry'     => 'US',
        'Cf-Connecting-Ip' => '192.168.8.1',
    ])->get('/');

    $location = GeoIp::getLocation();

    expect($location)->toHaveProperties([
        $propertyName => $value,
        'country'     => 'US',
        'ip'          => '192.168.8.1',
    ]);
})->with([
    ['Cf-Ipcity', 'city', 'New York'],
    ['Cf-Ipcontinent', 'continent', 'NA'],
    ['Cf-Iplatitude', 'latitude', '40.7128'],
    ['Cf-Iplongitude', 'longitude', '-74.0060'],
    ['Cf-Postal-Code', 'postalCode', '10001'],
    ['Cf-Region', 'region', 'NY'],
    ['Cf-Region-Code', 'regionCode', 'NY'],
    ['Cf-Timezone',    'timezone', 'America/New_York'],
]);

test('returns default localtion if headers are missing', function () {
    $location = GeoIp::getLocation();

    expect($location)->toHaveProperties([
        'ip'          => '127.0.0.0',
        'country'     => 'ES',
        'city'        => 'Barcelona',
        'continent'   => 'EU',
        'latitude'    => 41.3860606,
        'longitude'   => 2.1669603,
        'postalCode'  => '08002',
        'region'      => 'Barcelona',
        'regionCode'  => 'B',
        'timezone'    => 'Europe/Madrid',
    ]);
});

test('can return faux properties', function () {
    $location = GeoIp::getLocation();

    expect($location->ipAddress)->toBe('127.0.0.0');
    expect($location->iso_code)->toBe('ES');
    expect($location->isoCode)->toBe('ES');
    expect($location->lat)->toBe(41.3860606);
    expect($location->lon)->toBe(2.1669603);
    expect($location->postal_code)->toBe('08002');
    expect($location->state_name)->toBe('Barcelona');
    expect($location->stateName)->toBe('Barcelona');
    expect($location->state)->toBe('B');
});
