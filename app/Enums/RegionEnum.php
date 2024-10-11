<?php

namespace App\Enums;

enum RegionEnum: int
{
    case DISNEY_WORLD = 6034120;
    case DISNEYLAND_PARIS = 6286411;

    case DISNEY_HK = 6073737;

    public static function doesRegionRequireCityTaxCalculation(RegionEnum $enum): bool
    {
        return match ($enum->value) {
            self::DISNEY_WORLD->value => false,
            self::DISNEYLAND_PARIS->value => true,
        };
    }

    public static function doesRegionSupportDynamicPricing(RegionEnum $enum): bool
    {
        return match ($enum->value) {
            self::DISNEY_WORLD->value => true,
            self::DISNEYLAND_PARIS->value => false,
        };
    }

    public static function getRegionEnumById(int $id): RegionEnum
    {
        return match ($id) {
            self::DISNEY_WORLD->value => self::DISNEY_WORLD,
            self::DISNEYLAND_PARIS->value => self::DISNEYLAND_PARIS,
        };
    }

    public static function getCityTaxForRegionAndStarRating(RegionEnum $enum, int $stars): float
    {
        if ($enum->value == self::DISNEYLAND_PARIS->value) {
            return match ($stars) {
                1 => 2.60,
                2 => 3.25,
                3 => 5.20,
                4 => 8.13,
                5 => 10.73,
            };
        }

        return 0;
    }
}
