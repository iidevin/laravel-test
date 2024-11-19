<?php

namespace App\Services;

use App\Models\SqlLog;
use App\Traits\ServiceTrait;

class SqlLogService
{
    use ServiceTrait;

    /** @var  */
    public static $Model = SqlLog::CLASS;

}
