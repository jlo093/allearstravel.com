<?php

namespace App\Enums;

class DisneyHotelEnum
{
    const PORT_ORLEANS_FRENCH_QUARTER = 'po_french_quarter';
    const PORT_ORLEANS_RIVERSIDE = 'po_riverside';

    private array $identifierKeywords = [
        self::PORT_ORLEANS_FRENCH_QUARTER => [
            'French Quarter',
        ],
        self::PORT_ORLEANS_RIVERSIDE => [
            'Riverside'
        ],
    ];

    public function identifyByName(string $name): string
    {
        foreach ($this->identifierKeywords as $id => $keywords) {
            foreach ($keywords as $keyword) {
                if (str_contains($name, $keyword)) {
                    return $id;
                }
            }
        }

        return '';
    }
}
