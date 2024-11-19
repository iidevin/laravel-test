<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Goods;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GoodsExport;

use App\Services\GoodsService;

use App\Http\Resources\GoodsResource;

class GoodsController extends Controller
{
    /**
     *
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $pageSize = $request->input('limit', 10);
            $sort = $request->input('sort', '');
            $where = [];

            $list = GoodsService::getList($where, $pageSize, $sort ? [substr($sort, 1), str_starts_with($sort, '+') ? 'asc' : 'desc'] : ['id', 'desc']);

            $dataList = GoodsResource::collection($list);
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
            GoodsService::destroy($id);
            return success();
        } catch (\Exception $e) {
            return failed($e->getMessage(), $e->getCode());
        }
    }

    /**
     * export
     * @param Request $request
     * @return mixed
     */
    public function export(Request $request)
    {
        try {
            $type = $request->input('type', 'excel');
            $data = Goods::get();
            $fileName = date('YmdHis') . '-goods';
            if ($type == 'excel') {
                return Excel::download(new GoodsExport($data->toArray()), $fileName . '.xlsx');
            } else {
                $jsonContent = $data->toJson();
                return response($jsonContent)
                    ->header('Content-Type', 'application/json')
                    ->header('Content-Disposition', 'attachment; filename=' . $fileName . '.json');
            }
        } catch (\Exception $e) {
            return failed($e->getMessage(), $e->getCode());
        }
    }
}
