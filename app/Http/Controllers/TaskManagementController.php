<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskManagementController extends Controller
{
   public function store(Request $request)
     {
         // Basic validation
         $validatedData = $request->validate([
             'title' => 'required|max:255',
             'description' => 'required',
             'priority' => 'required|integer',
             'due_date' => 'required|date',
             'completed' => 'boolean',
         ]);

         // Create the task
         $task = Task::create($validatedData);

         // Return a simple response
   return response()->json(['message' => 'Task created successfully', 'task' => $task], 200);
     }



     public function show()
     {
       $tasks = Task::all();
       return view('task1.show', compact('tasks'));

     }

    
    public function delete($taskId)
    {
        $task = Task::find($taskId);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }






      public function get($taskId)
   {  
    $task = Task::find($taskId);

    if (!$task) {
        return response()->json(['message' => 'Task not found'], Response::HTTP_NOT_FOUND);
    }

    return response()->json($task);

    }




    public function edit($taskId)
    {
        $task = Task::find($taskId);
        return view('task1.edit', compact('task'));
    }



       public function update(Request $request, $taskId)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|integer|min:1',
            'due_date' => 'required|date',
            'completed' => 'required|boolean',
        ]);
    
        $task = Task::findOrFail($taskId);

        $task->update($validatedData);

      
        return response()->json(['message' => 'Task updated successfully'], 200);
    }

}
