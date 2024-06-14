<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Image\Facades\Image;

class ImageDimensions implements Rule
{
    protected $width;
    protected $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function passes($attribute, $value)
    {
        // Open the image using Intervention Image
        $image = Image::make($value);

        // Check if the image dimensions match the specified width and height
        return $image->width() == $this->width && $image->height() == $this->height;
    }

    public function message()
    {
        return "The :attribute must be exactly {$this->width}x{$this->height} pixels.";
    }
}
