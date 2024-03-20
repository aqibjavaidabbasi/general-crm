<?php

namespace App\Enums;

use Rexlabs\Enum\Enum;

/**
 * The ImageSizes enum.
 *
 * @method static self SIZE_150x150()
 * @method static self SIZE_240x240()
 * @method static self SIZE_300x188()
 * @method static self SIZE_525x328()
 * @method static self SIZE_580x363()
 * @method static self SIZE_768x480()
 * @method static self SIZE_1024x680()
 * @method static self SIZE_1536x690()
 */
class ImageSizes extends Enum
{
    const SIZE_150x150 = 'size_150x150';
    const SIZE_240x240 = 'size_240x240';
    const SIZE_300x188 = 'size_300x188';
    const SIZE_525x328 = 'size_525x328';
    const SIZE_580x363 = 'size_580x363';
    const SIZE_768x480 = 'size_768x480';
    const SIZE_1024x680 = 'size_1024x680';
    const SIZE_1536x690 = 'size_1536x690';

    public static function map(): array
    {
        return [
            static::SIZE_150x150 => '150x150',
            static::SIZE_240x240 => '240x240',
            static::SIZE_300x188 => '300x188',
            static::SIZE_525x328 => '525x328',
            static::SIZE_580x363 => '580x363',
            static::SIZE_768x480 => '768x480',
            static::SIZE_1024x680 => '1024x680',
            static::SIZE_1536x690 => '1536x690',
        ];
    }
}
