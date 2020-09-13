<?php

namespace App\Http\Controllers;

use App\Helper\TaskEmailManager;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    //
    public function landing()
    {
        return view('welcome');
    }

    public function create(Request $request)
    {
        try {
            $result = TaskEmailManager::create($request->all());
        } catch (\Exception $exception) {
            $err_msg = 'process fail';
        }
        return response()->json([
            'status' => $result['status'] ?? -1,
            'err_msg' => $err_msg ?? ''
        ]);

    }
}
