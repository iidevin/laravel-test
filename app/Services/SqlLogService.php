<?php

namespace App\Services;

use App\Models\VideoLog;
use App\Traits\ServiceTrait;

class SqlLogService
{
    use ServiceTrait;

    /** @var VideoLog */
    public static $Model = VideoLog::CLASS;

    public static function options()
    {
        return VideoLog::where(['status' => 1])->orderBy('sort')->pluck('title', 'id');
    }
}
