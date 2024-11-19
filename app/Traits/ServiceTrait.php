<?php

namespace App\Traits;

trait  ServiceTrait
{
    /**
     * create
     * @param $data
     * @param $whereData
     * @return mixed
     */
    public static function create($data, $whereData = [])
    {
        if ($whereData) {
            $user = self::$Model::firstOrCreate($whereData, $data);
        } else {
            $user = self::$Model::create($data);
        }

        return $user;
    }

    /**
     * update
     * @param $data
     * @param $where
     * @return mixed
     */
    public static function update($data, $where)
    {
        $res = self::$Model::where($where)->update($data);

        return $res;
    }

    /**
     * updateCreate
     * @param $data
     * @param $where
     * @return mixed
     */
    public static function updateCreate($data, $where)
    {
        return self::$Model::updateOrCreate($where, $data);
    }

    /**
     *  get one record
     * @param $where
     * @param $with
     * @return mixed
     */
    public static function getInfo($where, $with = [])
    {
        return self::$Model::with($with)->where($where)->first();
    }

    /**
     *  get one record
     * @param $where
     * @param $with
     * @param $order
     * @return mixed
     */
    public static function getOne($where, $with = [], $order = [])
    {
        $model = self::$Model::with($with)->where($where);
        if ($order) {
            $model->orderBy($order[0] ?? 'id', $order[1] ?? 'asc');
        }
        return $model->first();
    }

    /**
     * get more records
     * @param $where
     * @param int $page_size
     * @param array $order
     * @param string $group
     * @param array $with
     * @param array $withCount
     * @return mixed
     */
    public static function getList($where, int $page_size = 0, array $order = [], string $group = '', array $with = [], array $withCount = [])
    {
        $model = self::$Model::where($where);
        if ($with) {
            $model->with($with);
        }
        if ($withCount) {
            $model->withCount($withCount);
        }
        if ($order) {
            if (is_array($order[0])) {
                foreach ($order as $item) {
                    $model->orderBy($item[0], $item[1] ?? 'asc');
                }
            } else {
                $model->orderBy($order[0], $order[1] ?? 'asc');
            }
        }
        if ($group) {
            $model->groupBy($group);
        }
        return $page_size ? $model->paginate($page_size) : $model->get();
    }

    /**
     * call model static function
     * @param $funName
     * @param $args
     * @return mixed
     */
    public static function __callStatic($funName, $args)
    {
        $res = self::$Model::$funName(...$args);

        return $res;
    }
}
