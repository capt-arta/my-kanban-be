<?php

namespace App\Http\Controllers;

use App\Helper\Response;
use App\Models\SubTask;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    // function getColorHex($value) {
    //     switch ($value) {
    //         case 'Arta':
    //             return '#deebff';
    //         case 'Syifa':
    //             return '#eae6ff';
    //         case 'Wahyu':
    //             return '#e1dddf';
    //         case 'Alfina':
    //             return '#d0c8ec';
    //         default:
    //             return '#f3f3f3';
    //     }
    // }

    public function get() {
        // $data = Task::query()->orderBy('created_at', 'desc')->get();
        function getColorHex($value) {
            switch ($value) {
                case 'Arta':
                    return '#deebff';
                case 'Syifa':
                    return '#eae6ff';
                case 'Wahyu':
                    return '#e1dddf';
                case 'Alfina':
                    return '#d0c8ec';
                default:
                    return '#f3f3f3';
            }
        }
        // foreach ($data as &$task) {
            //     $task['color'] = getColorHex($task['person']); 
        // }
        // return Response::success([
        //     'data' => $data,
        // ]);
        $data = Task::query()->orderBy('created_at', 'desc')->get();

        // Group tasks by status
        $groupedData = [
            'REQUESTED' => ['name' => 'REQUESTED', 'items' => []],
            'TO DO' => ['name' => 'TO DO', 'items' => []],
            'IN PROGRESS' => ['name' => 'IN PROGRESS', 'items' => []],
            'DONE' => ['name' => 'DONE', 'items' => []],
        ];
        foreach ($data as $task) {
            $task['color'] = getColorHex($task['person']);
            $groupedData[$task['status']]['items'][] = $task;
        }
        
        $result = array_values($groupedData); // Re-index the array with numeric keys
        
        return Response::success([
            'data' => $result,
        ]);
        
        // foreach ($data as $task) {
        //     $task['color'] = getColorHex($task['person']);
        //     $groupedData[$task['status']]['items'][] = $task;
        // }
        
        // $result = [];
        // $index = 1;
        // foreach ($groupedData as $status => $group) {
        //     $result[$index] = $group;
        //     $index++;
        // }

        // return Response::success([
        //     'data' => $result,
        // ]);
    }

    public function getList() {
        
        $data = Task::query()->orderBy('created_at', 'desc')->get();
    
        // function getColorHex($value) {
        //     switch ($value) {
        //         case 'Arta':
        //             return '#deebff';
        //         case 'Syifa':
        //             return '#eae6ff';
        //         case 'Wahyu':
        //             return '#e1dddf';
        //         case 'Alfina':
        //             return '#d0c8ec';
        //         default:
        //             return '#f3f3f3';
        //     }
        // }

        // foreach ($data as $task) {
        //     $task['color'] = getColorHex($task['person']);
        // }

        return Response::success([
            'data' => $data,
        ]); 
    }

    public function store(Request $request, Task $fTask)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'person' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return Response::failed([
                'message' => $validator->errors()->first(),
                'error' => $validator->errors()
            ]);
        }

        try {
            DB::beginTransaction();

            $validatedData = $request->only($fTask->getFillable());
            $validatedData['status'] = 'REQUESTED';
            $data = Task::create($validatedData);

            DB::commit();
            return Response::success([
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return Response::failed(['error' => $th->getMessage()]);
        }
    }
    public function show(string $id)
    {
        try {
            $task = Task::findOrFail($id);
            $subTask = SubTask::select()->where('task_id', $id)->get();

            $data = [
                'id' => $task->id,
                'name' => $task->name,
                'description' => $task->description,
                'person' => $task->person,
                'start_date' => $task->start_date,
                'end_date' => $task->end_date,
                'status' => $task->status,
                'sub_task' => $subTask,
            ];
            return Response::success([
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return Response::failed([
                'message' => 'no data exist!'
            ]);
        }
    }
    public function update(Request $request, string $id, Task $fTask)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'person' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return Response::failed([
                'message' => $validator->errors()->first(),
                'error' => $validator->errors()
            ]);
        }

        $validatedData = $request->only($fTask->getFillable());
    
        try {
            DB::beginTransaction();
    
            $task = Task::findOrFail($id);
            $task->update($validatedData);
    
            DB::commit();
            return Response::success();
        } catch (Exception $th) {
            DB::rollBack();
            return Response::failed(['error' => $th->getMessage()]);
        }   
    }
    public function destroy(string $id)
    {
        $listOfValue = Task::findOrFail($id);
        $listOfValue->delete();

        return Response::success([
            'message' => 'data succesfully deleted'
        ]);
    }
}
