<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    use HasUuids;

    protected $table = 'sub_task';    

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'task_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
