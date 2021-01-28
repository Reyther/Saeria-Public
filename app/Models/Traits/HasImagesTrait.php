<?php

namespace App\Models\Traits;

use App\Rules\BackpackImage;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use enshrined\svgSanitize\Sanitizer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait HasImagesTrait
{
    /**
     * Store image & update attribute.
     *
     * @param string|null $attribute
     * @param string|null $value Image
     * @param string      $path
     * @param string      $disk
     *
     * @return string|null
     */
    public function setImageMutator(
        ?string $attribute,
        ?string $value,
        $path = 'images',
        string $disk = 'public'
    ): ?string {
        $disk = Storage::disk($disk);

        // if the image was erased
        if ($value === null) {
            // delete the image from disk
            if ($attribute) {
                $this->deleteImage($attribute);

                // set null in the database column
                $this->attributes[$attribute] = null;
            }

            return null;
        }

        if (Str::startsWith($value, 'data:image')) {
            // 0. Make the image
            if (Str::startsWith($value, 'data:' . BackpackImage::MIME_SVG)) {
                $ext      = 'svg';
                $base64   = str_replace('data:image/svg+xml;base64,', '', $value);
                $dirtySVG = base64_decode($base64);
                $content  = (new Sanitizer())->sanitize($dirtySVG);
                $content  = preg_replace('/<\?xml.*\?>/', '', $content);
                $content  = preg_replace('/<!--.*-->/', '', $content);
            } else {
                $image = Image::make($value);
                $ext   = null;
                switch ($image->mime) {
                    case BackpackImage::MIME_JPEG:
                        $image = $image->encode('jpg', 90);
                        $ext   = 'jpg';
                        break;
                    case BackpackImage::MIME_PNG:
                        $image = $image->encode('png');
                        $ext   = 'png';
                        break;
                    default:
                        Image::make('Invalid mime-type, throw image error')
                            ->encode('jpg', 90);

                        return null;
                }

                $content = $image->stream();
            }

            // 1. Generate a filename.
            $filename = md5($value . time()) . ".$ext";

            // 2. Store the image on disk.
            $disk->put($path . '/' . $filename, $content);

            $value = "$path/$filename";
            if ($attribute) {
                // 3. Delete the previous image, if there was one.
                $this->deleteImage($attribute);

                // 4. Save the public path to the database
                $this->attributes[$attribute] = $value;
            }
        }

        return $this->stripBaseUrl($value);
    }

    /**
     * Drop image
     *
     * @param string $attribute
     * @param string $disk
     */
    public function deleteImage(string $attribute, string $disk = 'public')
    {
        $imagePath = $this->{$attribute};
        if ($imagePath === null) {
            return;
        }

        if (in_array(HasTranslations::class, class_uses($this))) {
            /** @var HasTranslations $this */
            foreach ($this->getTranslations($attribute) as $locale => $translation) {
                if ($locale === $this->getLocale()) {
                    continue;
                }
                if ($translation === $imagePath) {
                    return;
                }
            }
        }

        $disk = Storage::disk($disk);

        if ($disk->exists($imagePath)) {
            $disk->delete($imagePath);
        }
    }

    /**
     * Remove disk base-url to keep only disk path.
     *
     * @param string $imagePath
     * @param string $disk
     *
     * @return string
     */
    public function stripBaseUrl(string $imagePath, string $disk = 'public'): string
    {
        $baseUrl = Storage::disk($disk)
            ->url('/');
        if (Str::startsWith($imagePath, $baseUrl)) {
            $imagePath = substr($imagePath, strlen($baseUrl));
        }

        return $imagePath;
    }
}
