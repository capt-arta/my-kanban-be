<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasUuids;

    protected $table = 'task';    

    protected $fillable = [
        'name',
        'description',
        'person',
        'start_date',
        'end_date',
        'status',
        'progress',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function subTasks()
    {
        return $this->hasMany(SubTask::class, 'task_id');
    }
}
