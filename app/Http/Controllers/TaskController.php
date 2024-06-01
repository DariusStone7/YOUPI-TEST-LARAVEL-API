<?php

namespace App\Http\Controllers;

use App\Http\Requests\task\TaskFormRequest;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $tasks = Task::all();

            return response()->json([
                'status_code' => 200,
                'message' => 'taches recupérées avec succès',
                'tasks' => $tasks,
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status_code' => 500,
                'message' => 'une erreur est survenue',
                'tasks' => null,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskFormRequest $request)
    {
        try{
            $task = Task::create($request->validated());

            return response()->json([
                'status_code' => 200,
                'message' => 'Tache créé avec succès',
                'task' => $task,
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status_code' => 500,
                'message' => 'Echec, tache non créé. Une erreur est survenu',
                'error' => $e,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{
            $task = Task::find($id);

            if(isset($task)){
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Tache recupéré avec succès',
                    'task' => $task,
                ]);
            }
            return response()->json([
                'status_code' => 404,
                'message' => 'Tache inexistante',
                'task' => null,
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status_code' => 500,
                'message' => 'une erreur est survenue',
                'error' => $e,
            ]);
        }
        
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(TaskFormRequest $request, string $id)
    {
        try{
            $task = Task::find($id);

            if(isset($task)){
                $task->update($request->validated());

                return response()->json([
                    'status_code' => 200,
                    'message' => 'Tache modifié avec succès',
                    'task' => $task,
                ]);
            }
            return response()->json([
                'status_code' => 404,
                'message' => 'Tache inexistante',
                'task' => null,
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status_code' => 500,
                'message' => 'une erreur est survenue',
                'error' => $e,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $task = Task::find($id);

            if(isset($task)){
                $task->delete();

                return response()->json([
                    'status_code' => 200,
                    'message' => 'Tache supprimé avec succès',
                    'task' => $task,
                ]);
            }
            return response()->json([
                'status_code' => 404,
                'message' => 'Tache inexistante',
                'task' => null,
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status_code' => 500,
                'message' => 'une erreur est survenue',
                'error' => $e,
            ]);
        }
    }
}
