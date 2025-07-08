<?php

namespace App\Utils;

use Faker\Factory;
use Faker\Generator;

class RandomNameGenerator
{
    private Generator $faker;

    public function __construct(string $locale = 'fr_FR')
    {
        $this->faker = Factory::create($locale);
    }

    public function getRandomName(): string
    {
        return $this->faker->name;
    }

    public function getRandomFirstName(): string
    {
        return $this->faker->firstName;
    }

    public function getRandomLastName(): string
    {
        return $this->faker->lastName;
    }
}