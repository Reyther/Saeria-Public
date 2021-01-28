<?php

namespace App\Rules;

use enshrined\svgSanitize\Sanitizer;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class BackpackImage implements Rule
{
    const MIME_JPEG = 'image/jpeg';
    const MIME_PNG = 'image/png';
    const MIME_SVG = 'image/svg+xml';
    const ALLOWED_MIMES = [
        self::MIME_JPEG,
        self::MIME_PNG,
        self::MIME_SVG,
    ];

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (is_string($value) && Str::startsWith($value, 'data:image')) {
            try {
                if (Str::startsWith($value, 'data:' . self::MIME_SVG)) {
                    $base64   = str_replace('data:' . self::MIME_SVG . ';base64,', '', $value);
                    $dirtySVG = base64_decode($base64);
                    $content  = (new Sanitizer())->sanitize($dirtySVG);

                    return ! empty($content);
                }

                $image = \Image::make($value);

                return ! empty($image) && in_array($image->mime(), self::ALLOWED_MIMES);
            } catch (\Throwable $t) {
                return false;
            }
        } elseif (is_string($value)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.image');
    }
}
