<?php

namespace App;

use App\Models\Settings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MainService extends Model {

    public static function getTermAndYear() {
        $setting = Settings::first();

        return $setting;
    }
}