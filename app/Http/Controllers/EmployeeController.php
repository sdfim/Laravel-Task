<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeName;
use App\Models\Position;
use DB;
use App\DataTables\EmployeesDataTable;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use App\Rules\PhoneNumber;
use App\Services\PhotoService;

class EmployeeController extends Controller
{

    public function __construct(){
            $this->middleware('checkauth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function index()
    //{
    //    return view('employees.index', [
    //        'employees' => DB::table('employees')->paginate(15)
    //    ]);
    //}
    public function index(EmployeesDataTable $dataTable)
    {
        return $dataTable->render('employees.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PhotoService $photoService)
    {

        $request->validate([
            'photo' => 'file|max:5120',
            'phone' => ['required', 'unique:employees', new PhoneNumber],
            'name' => 'required|unique:employees|max:120|min:2',
            'email' => 'required|email|unique:employees|regex:/^.+@.+$/i',
            'salary' => 'required',
            'head_id' => 'required',
            'date_employment' => 'required',
        ]);

        $input = $request->all();

        //dd($request);
        // get HeadName
        $headName = Employee::select('id')->where('name', '=', $input["head_id"])->first();

        if ($request->hasFile('photo')) {
            $input["photo"] = $photoService->setPhoto($request);
        }

        $input["head_id"] = $headName->id;
        $input["admin_created_id"] = Auth::id();
        $input["admin_updated_id"] = Auth::id();

        Employee::create($input);

        return redirect()->route('employees.index')->with('success','employee updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        $count = Employee::where('head_id', '=', $employee->id)->count();
        return view('employees.show')
            ->withEmployee($employee)
            ->withCount($count);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd(Employee::findOrFail($id)->position()->first());
        //dd(Employee::find(11)->headName()->first()->name);
        $employee = Employee::findOrFail($id);
        $count = Employee::where('head_id', '=', $employee->id)->count();
        return view('employees.edit')->withEmployee($employee)->withCount($count);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, PhotoService $photoService)
    {
        $input = $request->all();

        if (array_key_exists('transfer', $input)) {
            $request->validate([
                'transfer' => 'required',
            ]);

            Employee::where('head_id', $id)->update(['head_id' => $input["transfer"], 'admin_updated_id' => Auth::id()]);

            return $this->destroy($id);
        }

        $request->validate([
            'photo' => 'file|max:5120',
            'phone' => ['required', new PhoneNumber],
            'name' => 'required|max:120|min:2',
            'email' => 'required|email|regex:/^.+@.+$/i',
            'salary' => 'required',
            'head_id' => 'required',
            'date_employment' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $input["photo"] = $photoService->setPhoto($request);
        }

        $input["head_id"] = Employee::where('name', '=', $input["head_name"])->get()[0]->id;
        $input["admin_updated_id"] = Auth::id();

        Employee::find($id)->update($input);

        return redirect()->route('employees.index')->with('success','employee updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd((new Employee)->getCount($id));
        if ( (new Employee)->getCount($id) > 0) {
            return $this->show($id);
        }

        $employee = Employee::find($id);
        if ($employee) {
            Storage::disk('local')->delete('public/img/faces/'.$employee->photo);
            Storage::disk('local')->delete('public/img/faces/sm-'.$employee->photo);
            $employee->delete();
        }
        return redirect()->route('employees.index')->with('success','employee deleted successfully');
    }


}
