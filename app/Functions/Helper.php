<?php

namespace App\Functions;

use Illuminate\Support\Str;

class Helper
{
    // Generate a unique slug from a given string
    public static function generateSlug($string, $model)
    {
        $original_slug = Str::slug($string, '-');

        $same_original_slug_count = $model::where('slug', 'LIKE', $original_slug . '%')->count();

        return $same_original_slug_count ? "{$original_slug}-{$same_original_slug_count}" : $original_slug;
    }

    // Get the reading time in minutes as an int from the given string
    public static function getReadingTime($string)
    {
        return ceil(str_word_count($string) / 200);
    }
}
