<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $id = $request->input('id', 0);

            return success();
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
            $id = $request->input('id', 0);

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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            return success();
        } catch (\Exception $e) {
            return failed($e->getMessage(), $e->getCode());
        }
    }
}
