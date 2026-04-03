<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskValidation;
use App\Http\Resources\TaskResource;

/**
 * @OA\Info(
 *     title="Laravel API Documentation using Swagger",
 *     version="1.0.0",
 *     description="Interactive documentation for Laravel Tasks API using Swagger"
 * )
 *
 * @OA\Tag(
 *     name="Tasks",
 *     description="Endpoints for managing Tasks in Laravel API Documentation using Swagger"
 * )
 */
class TaskController extends Controller {

    /**
     * @OA\Get(
     *     @OA\PathItem(
     *         path="/api/tasks",
     *     ),
     *     tags={"Tasks"},
     *     summary="Get all tasks",
     *     description="Retrieve all tasks using Laravel API Documentation with Swagger.",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response - list of tasks",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="title", type="string", example="First task"),
     *                     @OA\Property(property="description", type="string", example="This is a sample task description"),
     *                     @OA\Property(property="status", type="string", example="This is a sample task status")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function index() {
        return TaskResource::collection(Task::all());
    }

    /**
     * @OA\Post(
     *     @OA\PathItem(
     *         path="/api/tasks",
     *     ),
     *     tags={"Tasks"},
     *     summary="Create a new task",
     *     description="Store a new task record using Laravel API Documentation with Swagger.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","description","status"},
     *             @OA\Property(property="title", type="string", example="My New task"),
     *             @OA\Property(property="description", type="string", example="This is a description for the new task"),
     *             @OA\Property(property="status", type="string", example="This is a sample status new task")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=3),
     *                 @OA\Property(property="title", type="string", example="My New task"),
     *                 @OA\Property(property="description", type="string", example="This is a description for the new task"),
     *                 @OA\Property(property="status", type="string", example="This is a status for the new task")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=400, description="Validation error"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function store(TaskValidation $request) {
        $validated = $request->validate();
        Task::create($validated);

        return response()->json(['message' => 'Задача создана'], 201);
    }

    /**
     * @OA\Get(
     *     @OA\PathItem(
     *         path="/api/tasks/{id}",
     *     ),
     *     tags={"Tasks"},
     *     summary="Get a single task by ID",
     *     description="Retrieve a specific task by its ID using Laravel API Documentation with Swagger.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the task to retrieve",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task found successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="First task"),
     *                 @OA\Property(property="description", type="string", example="This is a sample task description"),
     *                 @OA\Property(property="status", type="string", example="This is a sample task status")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=400, description="Tsak not found")
     * )
     */
    public function show(Task $task) {
        return $task->toResource();
    }

    /**
     * @OA\Put(
     *     @OA\PathItem(
     *         path="/api/tasks",
     *     ),
     *     tags={"Tasks"},
     *     summary="Update a task",
     *     description="Put a update task record using Laravel API Documentation with Swagger.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id","title","description","status"},
     *             @OA\Property(property="id", type="integer", example=3),
     *             @OA\Property(property="title", type="string", example="Update task"),
     *             @OA\Property(property="description", type="string", example="This is a description for the update task"),
     *             @OA\Property(property="status", type="string", example="This is a sample status update task")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=3),
     *                 @OA\Property(property="title", type="string", example="Update task"),
     *                 @OA\Property(property="description", type="string", example="This is a description for the update task"),
     *                 @OA\Property(property="status", type="string", example="This is a status for the update task")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=400, description="Validation error"),
     *     @OA\Response(response=500, description="Server error")
     * )
     */
    public function update(TaskValidation $request, Task $task) {
        $validated = $request->validate();
        $task->update($validated);

        return response()->json(['message' => 'Задача обновлена',], 200);
    }

    /**
     * @OA\Delete(
     *     @OA\PathItem(
     *         path="/api/tasks/{id}",
     *     ),
     *     tags={"Tasks"},
     *     summary="Delete task by ID",
     *     description="Retrieve a specific delete task by its ID using Laravel API Documentation with Swagger.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the task to retrieve",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task found successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(response=400, description="Tsak not found")
     * )
     */
    public function destroy(Task $task) {
        $task->delete();

        return response()->json(['message' => 'Задача удалена'], 204);
    }
}
