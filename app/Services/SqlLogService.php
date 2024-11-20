<?php

namespace App\Services;

use App\Models\SqlLog;
use App\Traits\ServiceTrait;

class SqlLogService
{
    use ServiceTrait;

    /** @var SqlLog */
    public static $Model = SqlLog::CLASS;

    public static function createLog($user, $sql, $result = 'OK')
    {
        $data = [
            'user' => $user,
            'sql' => $sql,
            'result' => $result,
        ];

        return self::$Model::create($data);
    }

}
