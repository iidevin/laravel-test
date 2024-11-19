<?php

namespace App\Services;

use App\Models\Goods;
use App\Traits\ServiceTrait;

class GoodsService
{
    use ServiceTrait;

    /** @var Goods */
    public static $Model = Goods::CLASS;

}
