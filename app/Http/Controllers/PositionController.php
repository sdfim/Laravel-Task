<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\DataTables\PositionsDataTable;

class PositionController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkauth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(PositionsDataTable $dataTable)
    {
        return $dataTable->render('positions.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'position' => 'required|unique:positions|max:255',
            'level' => 'required|numeric|between:1,5'
        ]);

        $input = $request->all();
        //dd($input);

        $input["admin_created_id"] = Auth::id();
        $input["admin_updated_id"] = Auth::id();

        Position::create($input);

        return redirect()->route('positions.index')->with('success', 'position updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $position = Position::findOrFail($id);
        $count = Employee::where('position_id', '=', $position->id)->count();
        return view('positions.show')->withPosition($position)->withCount($count);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $position = Position::findOrFail($id);
        $count = Employee::where('position_id', '=', $position->id)->count();
        return view('positions.edit')->withPosition($position)->withCount($count);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        if (array_key_exists('transfer', $input)) {
            $request->validate([
                'transfer' => 'required',
            ]);

            Employee::where('position_id', $id)->update(['position_id' => $input["transfer"], 'admin_updated_id' => Auth::id()]);

            return $this->destroy($id);
        }

        $request->validate([
            'position' => 'required|unique:positions|max:255',
            'level' => 'required|numeric|between:1,5'
        ]);

        $input["admin_updated_id"] = Auth::id();

        Position::find($id)->update($input);

        return redirect()->route('positions.index')->with('success', 'position updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Position::find($id)->delete();

        return redirect()->route('positions.index')->with('success', 'position deleted successfully');
    }
}
