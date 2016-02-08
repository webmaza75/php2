<?php

namespace App\Models;

/**
 * Interface HasEmail
 * @package App\Models
 *
 */
interface HasEmail
{
    /**
     * @return string Email address
     */
    public function getEmail();
}
