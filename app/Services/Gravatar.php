<?php

namespace App\Services;

class Gravatar
{
    /**
     * Gravatar base URL.
     *
     * @var string
     */
    const BASE_URL = 'http://www.gravatar.com/avatar/';

    /**
     * Returns Gravatar full URL corresponding to specified parameters.
     *
     * @param string $email
     * @param int $size [1 - 2048]
     * @param string $default [404 | mm | identicon | monsterid | wavatar]
     * @param string $rating [g | pg | r | x]
     * @return string
     */
    public function get($email, $size = 80, $default = 'mm', $rating = 'g')
    {
        return static::BASE_URL . md5(mb_strtolower($email)) . '?s=' . $size . '&d=' . $default . '&r=' . $rating;
    }
}
