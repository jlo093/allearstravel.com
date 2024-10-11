<?php

namespace Database\Seeders;

use App\Enums\DisneyHotelEnum;
use App\Models\Hotel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Hotel::factory()->create([
            'ratehawk_id' => DisneyHotelEnum::ALL_STAR_SPORTS_RESORT,
            'stars' => 3,
            'name' => "Disney's All-Star Sports Resort",
            'category' => 'value',
            'has_bus' => true,
            'has_skyliner' => false,
            'has_boat' => false,
            'area_description' => 'The hotel is located near Animal Kingdom.',
            'description' => 'Get in the game at this Resort hotel that salutes the world of competitive sports, including baseball, basketball, football, surfing and tennis. Go the distance and don’t be afraid to celebrate your inner fan amid sporty décor starring some of your favorite Disney characters.'
        ]);
        Hotel::factory()->create([
            'ratehawk_id' => DisneyHotelEnum::ALL_STAR_MOVIES_RESORT,
            'stars' => 3,
            'name' => "Disney's All-Star Movies Resort",
            'category' => 'value',
            'has_bus' => true,
            'has_skyliner' => false,
            'has_boat' => false,
            'area_description' => 'The hotel is located near Animal Kingdom.',
            'description' => "Imagine yourself sharing the spotlight with some of your favorite Disney friends, as you headline your very own all-star adventure. Stay at a Disney Resort hotel that salutes the legends of Disney films—from the dotted pups of 101 Dalmatians to the playful toys of Andy's Room— with whimsical, larger-than-life décor."
        ]);
        Hotel::factory()->create([
            'ratehawk_id' => DisneyHotelEnum::ALL_STAR_MUSIC_RESORT,
            'stars' => 3,
            'name' => "Disney's All-Star Music Resort",
            'category' => 'value',
            'has_bus' => true,
            'has_skyliner' => false,
            'has_boat' => false,
            'area_description' => 'The hotel is located near Animal Kingdom.',
            'description' => 'Let the rhythm move you at this Resort hotel that pays homage to some of the world’s most popular music genres, including country, jazz, rock ‘n’ roll, calypso and Broadway-style show tunes. Large-sized, music-inspired icons outside and subtle song-and dance surprises inside provide a harmonious setting for music lovers of all ages.'
        ]);
        Hotel::factory()->create([
            'ratehawk_id' => DisneyHotelEnum::POP_CENTURY_RESORT,
            'stars' => 3,
            'name' => "Disney's Pop Century Resort",
            'category' => 'value',
            'has_bus' => true,
            'has_skyliner' => true,
            'has_boat' => false,
            'area_description' => "The hotel is located near Disney's Hollywood Studios and Ecpot with a direct connection via Skyliner.",
            'description' => 'Experience the unforgettable fads of the 1950s through the 1990s all over again. From yo-yos and Play-Doh® to Rubiks Cube® and rollerblades, this Resort hotel salutes the timeless fashions, catch phrases, toys and dances that captivated the world through the decades.'
        ]);
        Hotel::factory()->create([
            'ratehawk_id' => DisneyHotelEnum::ART_OF_ANIMATION,
            'stars' => 3,
            'name' => "Disney's Art of Animation Resort",
            'category' => 'value',
            'has_bus' => true,
            'has_skyliner' => true,
            'has_boat' => false,
            'area_description' => "The hotel is located near Disney's Hollywood Studios and Ecpot with a direct connection via Skyliner.",
            'description' => 'Be surrounded in the artistry, enchantment and magic of Disney and Pixar movies. Stay at a Disney Resort hotel that invites you to explore the storybook landscapes seen in such classics as Finding Nemo, Cars, The Lion King and The Little Mermaid. From delightfully themed family suites to wondrously detailed courtyards, Disney’s Art of Animation “draws” you and your family in to become a part of some of your animated favorites.'
        ]);
        Hotel::factory()->create([
            'ratehawk_id' => DisneyHotelEnum::CORONADO_SPRINGS,
            'stars' => 3,
            'name' => "Disney's Coronado Springs Resort",
            'category' => 'value',
            'has_bus' => true,
            'has_skyliner' => false,
            'has_boat' => false,
            'area_description' => "The hotel is located near Disney's Animal Kingdom.",
            'description' => 'Celebrate the unique blend of Spanish, Mexican and Southwest American cultures at Disney’s Coronado Springs Resort. This beautiful lakeside oasis offers classic influences, Disney touches and modern comforts to energize and inspire.'
        ]);
    }
}
