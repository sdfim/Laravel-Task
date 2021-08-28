<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position',
        'level',
        'admin_created_id',
        'admin_updated_id',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'position_id', 'id');
    }

    public function getLevel($id) {
        return Position::findOrFail($id)->level;
    }
}
