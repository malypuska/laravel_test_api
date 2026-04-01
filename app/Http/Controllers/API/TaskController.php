<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller {

    public function index() {
        return response()->json(Task::all());
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|min:50',
        ]);
        
        Task::create($validated);

        return response()->json(['message' => 'Задача создана'], 201);
    }

    public function show(Task $task) {
        return response()->json($task, 200);
    }

    public function update(Request $request, Task $task) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|min:50',
        ]);

        $task->update($validated);

        return response()->json(['message' => 'Задача обновлена',], 200);
    }

    public function destroy(Task $task) {
        $task->delete();

        return response()->json(['message' => 'Задача удалена'], 204);
    }
}
