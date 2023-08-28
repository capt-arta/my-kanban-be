<?php

namespace App\Http\Controllers;

use App\Helper\Response;
use App\Models\SubTask;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SubTaskController extends Controller
{
    public function get() {
        $data = SubTask::query()->orderBy('created_at', 'desc')->get();
        return Response::success([
            'data' => $data,
        ]);
    }
    public function store(Request $request, SubTask $fSubTask)
    {
        $task = Task::find($request->task_id);

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:100',
            'start_date' => 'required|date|before_or_equal:' . $task['end_date'],
            'end_date' => 'required|date|before_or_equal:' . $task['end_date'],
        ]);

        if ($validator->fails()) {
            return Response::failed([
                'message' => $validator->errors()->first(),
                'error' => $validator->errors()
            ]);
        }

        try {
            DB::beginTransaction();

            $validatedData = $request->only($fSubTask->getFillable());
            $data = SubTask::create($validatedData);

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
            $data = SubTask::findOrFail($id);
            return Response::success([
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return Response::failed([
                'message' => 'no data exist!'
            ]);
        }
    }
    public function update(Request $request, string $id, SubTask $fSubTask)
    {
        $subTask = SubTask::findOrFail($id);
        $task = Task::find($subTask->task_id);
        $validator = Validator::make($request->all(),[
            'name' => 'nullable|string|max:100',
            'start_date' => 'nullable|before_or_equal:' . $task['end_date'],
            'end_date' => 'nullable|before_or_equal:' . $task['end_date'],
        ]);

        if ($validator->fails()) {
            return Response::failed([
                'message' => $validator->errors()->first(),
                'error' => $validator->errors()
            ]);
        }

        $validatedData = $request->only($fSubTask->getFillable());
    
        try {
            DB::beginTransaction();
            $subTask->update($validatedData);

            DB::commit();
            return Response::success();
        } catch (Exception $th) {
            DB::rollBack();
            return Response::failed(['error' => $th->getMessage()]);
        }   
    }
    public function destroy(string $id)
    {
        $listOfValue = SubTask::findOrFail($id);
        $listOfValue->delete();

        return Response::success([
            'message' => 'data succesfully deleted'
        ]);
    }
}
