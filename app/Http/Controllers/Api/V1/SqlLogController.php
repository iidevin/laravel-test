<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\SqlLogService;

use App\Http\Resources\SqlLogResource;

class SqlLogController extends Controller
{
    /**
     * 检测结果日志列表
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $pageSize = $request->input('limit', 100);
            $sort = $request->input('sort', '');
            $where = [];

            $list = SqlLogService::getList($where, $pageSize, $sort ? [substr($sort, 1), str_starts_with($sort, '+') ? 'asc' : 'desc'] : ['id', 'desc']);

            $dataList = SqlLogResource::collection($list);
            return success(page_list($list, $dataList));
        } catch (\Exception $e) {
            return failed($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            return success();
        } catch (\Exception $e) {
            return failed($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            return success();
        } catch (\Exception $e) {
            return failed($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            return success();
        } catch (\Exception $e) {
            return failed($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            SqlLogService::destroy($id);
            return success();
        } catch (\Exception $e) {
            return failed($e->getMessage(), $e->getCode());
        }
    }

    /**
     * 查询检测结果
     * @param Request $request
     * @return JsonResponse
     */
    public function checkResult(Request $request)
    {
        try {

            $info = SqlLogService::where('status', 0)->orderBy('id', 'asc')->first();
            if ($info) {
                $info->status = 1;
                $info->save();
            }

            return success($info ? new SqlLogResource($info) : []);
        } catch (\Exception $e) {
            return failed($e->getMessage(), $e->getCode());
        }
    }
}