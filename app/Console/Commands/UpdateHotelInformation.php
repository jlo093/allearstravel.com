<?php

namespace App\Console\Commands;

use App\Models\Amenity;
use App\Models\Hotel;
use App\Models\Media;
use App\Models\Room;
use App\Services\RateHawk\API;
use App\Services\RateHawk\Requests\GetHotelInformationByIdRequest;
use App\Services\RateHawk\Responses\HotelInformationResponse;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class UpdateHotelInformation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-hotel-information';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will update amenities, descriptions and room information for all hotels.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hotels = Hotel::all();

        $ratehawk = new API(
            new Client()
        );

        /** @var Hotel $hotel */
        foreach ($hotels as $hotel) {
            if (empty($hotel->ratehawk_id)) {
                continue;
            }

            /** @var HotelInformationResponse $response */
            $response = $ratehawk->send(
                new GetHotelInformationByIdRequest(
                    $hotel->ratehawk_id
                )
            );

            $information = $response->hotelInformation;

            Amenity::where('hotel_id', $hotel->id)->delete();

            foreach ($information->amenity_groups as $amenityGroup) {
                foreach ($amenityGroup['amenities'] as $amenityDescription) {
                    $amenity = new Amenity();
                    $amenity->category = $amenityGroup['group_name'];
                    $amenity->description = $amenityDescription;
                    $amenity->hotel_id = $hotel->id;
                    $amenity->save();
                }
            }

            $hotelMedia = Media::where('model', Hotel::class)
                ->where('model_id', $hotel->id)
                ->first();

            if (empty($hotelMedia)) {
                foreach ($information->images as $imageUrl) {
                    $media = new Media();
                    $media->model = Hotel::class;
                    $media->model_id = $hotel->id;
                    $media->filename = $imageUrl;
                    $media->save();
                }
            }

            $hotel->latitude = $information->latitude;
            $hotel->longitude = $information->longitude;
            $hotel->address = $information->address;
            $hotel->checkin_time = $information->check_in_time;
            $hotel->checkout_time = $information->check_out_time;
            $hotel->meta_policy = $information->metapolicy_extra_info;
            $hotel->save();

            foreach ($information->room_groups as $group) {
                $hasRoom = Room::where('hotel_id', $hotel->id)
                    ->where('external_id', $group['room_group_id'])
                    ->first();

                if ($hasRoom) {
                    continue;
                }

                $room = new Room();
                $room->external_id = $group['room_group_id'];
                $room->hotel_id = $hotel->id;
                $room->name = $group['name'];
                $room->sleeper_capacity = 4;
                $room->save();

                foreach ($group['images'] as $imageUrl) {
                    $media = new Media();
                    $media->model = Room::class;
                    $media->model_id = $room->id;
                    $media->filename = $imageUrl;
                    $media->save();
                }
            }
        }
    }
}
