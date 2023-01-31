<?php

namespace App\Helpers;

use App\Models\Options;

class AppHelper
{
    public function getOptions($name)
    {
        $setting = Options::where('name', $name)->first();
        if (!$setting) {
            return '';
        }
        return $setting->value;
    }
    public static function instance()
    {
        return new AppHelper();
    }
}
