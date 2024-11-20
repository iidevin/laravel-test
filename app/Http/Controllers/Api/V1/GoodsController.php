<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\SqlLogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
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
        $user = auth()->user()->name ?? '';
        $sql = $request->input('sql', '');
        try {
            if (empty($sql)) {
                throw new \Exception('sql can not empty');
            }
            if (!preg_match('/^\s*select\s+/i', $sql)) {
                throw new \Exception('only support select sql');
            }
            $pageSize = $request->input('limit', 10);
            $page = $request->input('page', 1);
            $list = DB::select("{$sql} LIMIT :offset, :limit", [
                'offset' => ($page - 1) * $pageSize,
                'limit' => $pageSize
            ]);
            $total = DB::select("SELECT COUNT(*) AS total FROM ( {$sql} ) AS subquery")[0]->total ?? 0;
            $pageData = [
                'perPage' => $pageSize,
                'currentPage' => $page,
                'total' => $total,
                'lastPage' => ceil($total / $pageSize),
                'list' => $list
            ];
            SqlLogService::createLog($user, $sql);
            return success($pageData);
        } catch (\Exception $e) {
            if ($e instanceof QueryException) {
                $sql && SqlLogService::createLog($user, $sql, $e->getMessage());
            }
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
            $type = $request->input('type', '');
            $sql = $request->input('sql', '');
            if (empty($sql)) {
                throw new \Exception('sql can not empty');
            }
            if (!preg_match('/^\s*select\s+/i', $sql)) {
                throw new \Exception('only support select sql');
            }
            $data = DB::select("{$sql}");
            $fileName = date('YmdHis') . '-goods';
            if ($type == 'excel') {
                return Excel::download(new GoodsExport($data), $fileName . '.xlsx');
            } else {
                $jsonContent = json_encode($data);
                return response($jsonContent)
                    ->header('Content-Type', 'application/json')
                    ->header('Content-Disposition', 'attachment; filename=' . $fileName . '.json');
            }
        } catch (\Exception $e) {
            return failed($e->getMessage(), $e->getCode());
        }
    }
}
