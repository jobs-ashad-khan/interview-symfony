<?php

namespace App\Service;

use Faker\Factory;
use Faker\Generator;

class NameGeneratorService
{
    private Generator $faker;

    public function __construct(string $locale = 'fr_FR')
    {
        $this->faker = Factory::create($locale);
    }

    public function setLocale(string $locale = 'fr_FR'): void
    {
        $this->faker = Factory::create($locale);
    }

    public function getName(): string
    {
        return $this->faker->name;
    }

    public function getFirstName(): string
    {
        return $this->faker->firstName;
    }

    public function getLastName(): string
    {
        return $this->faker->lastName;
    }
}