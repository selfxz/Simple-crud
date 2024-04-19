<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // traeme del ultimo al primero y amacenala en la variable
        $tasks = task::latest()->paginate(3);
        return view('index',['tasks'=> $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // solo muestra la vista del formulario para crear donde se escribe la logica para almacenar es en store
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title'=> 'required',
            'descripcion'=> 'required'
        ]);
        task::create($request -> all());
        return redirect()->route('tasks.index')->with('Success','Nueva tarea creada exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // mostar el formulario para editar
    public function edit($id): View
    {
        $task = Task::find($id);
        return view('edit',['task'=>$task]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, task $task): RedirectResponse
    {   
        $request->validate([
            'title'=> 'required',
            'descripcion'=> 'required'
        ]);
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('Success','Tarea editada exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(task $task): RedirectResponse
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('Success','Tarea eliminada exitosamente!');
    }
}
