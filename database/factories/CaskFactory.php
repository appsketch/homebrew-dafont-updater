<?php

use Faker\Generator as Faker;

use Updater\Enumerations\Version;

$factory->define(Updater\Models\Cask::class, function (Faker $faker) {
    return [
        'name' => $faker->streetName,
        'version' => Version::LATEST(),
        'sha256' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        'url' => $faker->url,
        'homepage' => $faker->url,
        'fonts' => [
            $faker->streetName . '.ttf',
            $faker->streetName . '.ttf',
            $faker->streetName . '.ttf'
        ]
    ];
});
