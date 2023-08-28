<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = [
            [
                "id" => "99ff2091-c9fa-439f-a2fd-812c87bd9938",
                "name" => "test ajari app",
                "description" => null,
                "person" => "Wahyu",
                "start_date" => "2023-08-01",
                "end_date" => "2023-08-31",
                "status" => "REQUESTED",
                "color" => "#e1dddf"
            ],
            [
                "id" => "99ff2021-5d17-4f5a-8201-b0c12d876778",
                "name" => "Task Force 86",
                "description" => null,
                "person" => "Arta",
                "start_date" => "2023-08-01",
                "end_date" => "2023-09-30",
                "status" => "REQUESTED",
                "color" => "#deebff"
            ],
            [
                "id" => "99ff1f6e-b1cc-4175-9317-a87c25391f39",
                "name" => "Task Force 141",
                "description" => "Captain $",
                "person" => "Arta",
                "start_date" => "2023-08-01",
                "end_date" => "2023-08-31",
                "status" => "REQUESTED",
                "color" => "#deebff"
            ],
            [
                "id" => "99f8fbcb-8dd1-4673-8ee3-4d5a62e9b662",
                "name" => "Task 3",
                "description" => "",
                "person" => "Syifa",
                "start_date" => "2023-08-24",
                "end_date" => "2023-08-31",
                "status" => "REQUESTED",
                "color" => "#eae6ff"
            ],
            [
                "id" => "99f8f993-ccea-4a80-be55-0932d9906aeb",
                "name" => "Task 2",
                "description" => "",
                "person" => "Syifa",
                "start_date" => "2023-08-24",
                "end_date" => "2023-08-31",
                "status" => "REQUESTED",
                "color" => "#eae6ff"
            ],
            [
                "id" => "99f884fc-ca24-478f-afeb-3750db3e1a8a",
                "name" => "Task 1",
                "description" => "",
                "person" => "Arta",
                "start_date" => "2023-08-24",
                "end_date" => "2023-08-31",
                "status" => "REQUESTED",
                "color" => "#deebff"
            ]
        ];
        
        foreach ($tasks as $taskData) {
            Task::create($taskData);
        }
    }
}
