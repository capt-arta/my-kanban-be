<?php

namespace Database\Seeders;

use App\Models\SubTask;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Retrieve tasks to associate subtasks with
        $tasks = Task::all();

        foreach ($tasks as $task) {
            $subTasks = [
                [
                    'name' => 'SubTask 1 for ' . $task->name,
                    'start_date' => now(),
                    'end_date' => now()->addDays(7),
                    'task_id' => $task->id,
                ],
            ];

            foreach ($subTasks as $subTaskData) {
                SubTask::create($subTaskData);
            }
        }
    }
}
