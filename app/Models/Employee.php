<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Position;
use Log;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'photo',
        'name',
        'phone',
        'email',
        'position_id',
        'salary',
        'head_id',
        'date_employment',
        'admin_created_id',
        'admin_updated_id',
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }


    public function headId()
    {
        return $this->belongsTo(Employee::class, 'id', 'head_id');
    }

    public function headName()
    {
        return $this->hasOne(Employee::class, 'head_id', 'id');
    }

    public function getListHead($id)
    {
        //dd(Position::findOrFail($id));
        $minLevel = Position::findOrFail($id)->level;
        $data = Employee::select('*')
                ->join('positions', 'employees.position_id', '=', 'positions.id')
                ->where('positions.level', '>=',  $minLevel)
                ->pluck('name', 'id');
        Log::info(count($data));

        return $data;
    }

    public function getCount($id)
    {
        $employee = Employee::findOrFail($id);
        return Employee::where('head_id', '=', $employee->id)->count();
    }

}
