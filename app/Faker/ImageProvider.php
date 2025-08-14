<?php

namespace App\Faker;

use Faker\Provider\Base;

class ImageProvider extends Base
{
    public function imageUrl(int $width = 640, int $height = 480, ?string $bgColor = null, ?string $text = null): string
    {
        $bgColor = $bgColor ?: ltrim($this->generator->hexColor(), '#');
        $fgColor = 'FFFFFF';
        $text    = $text ?: $this->generator->word();

        return sprintf(
            'https://placehold.co/%dx%d/%s/%s?text=%s',
            $width,
            $height,
            $bgColor,
            $fgColor,
            urlencode($text)
        );
    }
}
