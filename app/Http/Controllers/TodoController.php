<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Todo::orderBy('task', 'asc')->get();
        //dd($data);
        return view('todo.app', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        //! proses untuk validasi
        $request->validate(
            [
                'task' => 'required|min:3|max:25'
            ],
            [
                'task.required' => 'Field task wajib diisi',
                'task.min' => 'Minimal isian task adalah 3 karakter',
                'task.max' => 'Minimal isian task adalah 25 karakter',
            ]
        );

        $data = [
            'task' => $request->input('task')
        ];

        Todo::create($data);
        return redirect()->route('todo')->with('suksesBro', 'Berhasil simpan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //! proses untuk validasi
        $request->validate(
            [
                'task' => 'required|min:3|max:25'
            ],
            [
                'task.required' => 'Field task wajib diisi',
                'task.min' => 'Minimal isian task adalah 3 karakter',
                'task.max' => 'Minimal isian task adalah 25 karakter',
            ]
        );

        $data = [
            'task' => $request->input('task'),
            'is_done' => $request->input('is_done')
        ];

        Todo::where('id', $id)->update($data);
        return redirect()->route('todo')->with('suksesBro', 'Data berhasil di upadte');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
