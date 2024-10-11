<?php

namespace App\Enums;

class DisneyHotelEnum
{
    const PORT_ORLEANS_FRENCH_QUARTER = 'disneys_port_orleans_resort_french_quarter';
    const PORT_ORLEANS_RIVERSIDE = 'disneys_port_orleans_resort_riverside';
    const CORONADO_SPRINGS = 'disneys_coronado_springs_resort';
    const ART_OF_ANIMATION = 'disneys_art_of_animation_resort';
    const CARIBBEAN_BEACH = 'disneys_caribbean_beach_resort';
    const POLYNESIAN_RESORT = 'disneys_polynesian_resort';
    const ANIMAL_KINGDOM_LODGE = 'disneys_animal_kingdom_lodge';
    const DOLPHIN = 'walt_disney_world_dolphin_2';
    const SWAN = 'walt_disney_world_swan';
    const GRAND_FLORIDIAN_RESORT = 'disneys_grand_floridian_resort__spa';
    const BOARDWALK_INN = 'disneys_boardwalk_inn';
    const SARATOGA_SPRINGS_RESORT = 'disneys_saratoga_springs_resort__spa';
    const FORT_WILDERNESS_RESORT = 'disneys_fort_wilderness_resort__campground';
    const OLD_KEY_WEST_RESORT = 'disneys_old_key_west_resort';
    const ANIMAL_KINGDOM_VILLAS = 'disneys_animal_kingdom_villas_jambo_house';
    const CONTEMPORARY_RESORT = 'disneys_contemporary_resort_2';
    const SWAN_RESERVE = 'walt_disney_world_swan_reserve';
    const ALL_STAR_SPORTS_RESORT = 'disneys_allstar_sports_resort';
    const ALL_STAR_MOVIES_RESORT = 'disneys_allstar_movies_resort';
    const POP_CENTURY_RESORT = 'disneys_pop_century_2';
    const ALL_STAR_MUSIC_RESORT = 'disneys_allstar_music_resort';
    const SANTE_FE = 'disneys_hotel_santa_fe';
    const NEWPORT_BAY = 'disneys_newport_bay_clubr';

    private array $identifierKeywords = [
        self::PORT_ORLEANS_FRENCH_QUARTER => ['French Quarter'],
        self::PORT_ORLEANS_RIVERSIDE => ['Riverside'],
        self::CORONADO_SPRINGS => ['Coronado'],
        self::ART_OF_ANIMATION => ['Animation'],
        self::CARIBBEAN_BEACH => ['Caribbean'],
        self::POLYNESIAN_RESORT => ['Polynesian'],
        self::ANIMAL_KINGDOM_LODGE => ['Animal'],
        self::DOLPHIN => ['Dolphin'],
        self::SWAN => ['Swan'],
        self::SWAN_RESERVE => ['Swan Reserve'],
        self::GRAND_FLORIDIAN_RESORT => ['Floridian'],
        self::BOARDWALK_INN => ['Boardwalk'],
        self::SARATOGA_SPRINGS_RESORT => ['Saratoga'],
        self::FORT_WILDERNESS_RESORT => ['Wilderness'],
        self::OLD_KEY_WEST_RESORT => ['Key West'],
        self::ANIMAL_KINGDOM_VILLAS => ['Jambo'],
        self::CONTEMPORARY_RESORT => ['Contemporary'],
        self::ALL_STAR_MUSIC_RESORT => ['Music'],
        self::ALL_STAR_MOVIES_RESORT => ['Movies'],
        self::ALL_STAR_SPORTS_RESORT => ['Sports'],
        self::POP_CENTURY_RESORT => ['Century'],
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
