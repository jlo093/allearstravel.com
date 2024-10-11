<?php

namespace App\Enums;

enum BookingTypeEnum: string
{
    case HOTEL = 'hotel';
    case TICKET = 'ticket';

    public static function getEnumByString(string $bookingType): BookingTypeEnum
    {
        return match ($bookingType) {
            self::HOTEL->value => self::HOTEL,
            self::TICKET->value => self::TICKET,
        };
    }
}
