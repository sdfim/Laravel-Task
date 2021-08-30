<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use Log;

class EmployeeSearchController extends Controller
{

    public function autocomplete(Request $request)
    {
        //Log::info($request);
        $minLevel = Position::where('id', '=', $request->input('position_id'))->first()->level;
        $data = Employee::select('name')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->where('name', 'LIKE', "%{$request->input('query')}%")
            ->where('positions.level', '>=',  $minLevel)
            ->get();

        return response()->json($data);
    }
}
