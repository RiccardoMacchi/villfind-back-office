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

    // Generate a string of text containing five empty, half or full star icons (font awesome tags) to display the given the rating and the max rating
    public static function iconifyRating($rating, $max_rating = 5)
    {
        if ($max_rating != 5) {
            $rating = ($rating / $max_rating) * 5;
        }

        $rating_in_stars = '';

        for ($i = 0; $i < 5; $i++) {
            if ($rating - $i > 0.75) {
                $rating_in_stars .= '<i class="fa-solid fa-star"></i>';
            } elseif ($rating - $i > 0.25) {
                $rating_in_stars .= '<i class="fa-regular fa-star-half-stroke"></i>';
            } else {
                $rating_in_stars .= '<i class="fa-regular fa-star"></i>';
            }
        }

        return $rating_in_stars;
    }
}
