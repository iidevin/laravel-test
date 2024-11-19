<?php

if (!function_exists('success')) {

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    function success($data = [])
    {
        return response()->json(['code' => 200, 'status' => 'success', 'data' => $data ? $data : []]);
    }
}

if (!function_exists('failed')) {

    /**
     * @param string $msg
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    function failed($msg = '', $code = 0)
    {
        return response()->json(['code' => $code ?: -201, 'status' => 'failed', 'msg' => $msg ? $msg : '操作失败']);
    }
}

if (!function_exists('page_list')) {
    /**
     * @param $paginate
     * @param $dataList
     * @param array $other
     * @return array
     */
    function page_list(&$paginate, $dataList = [], $other = [])
    {
        return [
                'perPage' => $paginate->perPage(),
                'currentPage' => $paginate->currentPage(),
                'total' => $paginate->total(),
                'lastPage' => $paginate->lastPage(),
                'list' => $dataList ?: $paginate->toArray()['data']
            ] + $other;
    }
}
