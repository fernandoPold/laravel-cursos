<?php

namespace App\Http\Controllers;

use App\Services\Contracts\CursoServiceInterface;
use App\Http\Requests\CursoStoreRequest;
use Illuminate\Routing\Controller as BaseController;
use Exception;

class CursoController extends BaseController
{
    protected CursoServiceInterface $cursoService;

    public function __construct(CursoServiceInterface $cursoService)
    {
        $this->cursoService = $cursoService;
    }

    public function index()
    {
        $cursos = $this->cursoService->obtenerTodos();
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(CursoStoreRequest $request)
    {
        try {
            $this->cursoService->registrarCurso($request->validated());
            return redirect()->route('cursos.index')->with('success', '¡Curso registrado exitosamente en la plataforma!');
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error_negocio' => $e->getMessage()]);
        }
    }

    public function show(int $id)
    {
        try {
            $curso = $this->cursoService->obtenerPorId($id);
            return view('cursos.show', compact('curso'));
        } catch (Exception $e) {
            return redirect()->route('cursos.index')->withErrors(['error_negocio' => $e->getMessage()]);
        }
    }

    public function edit(int $id)
    {
        try {
            $curso = $this->cursoService->obtenerPorId($id);
            return view('cursos.edit', compact('curso'));
        } catch (Exception $e) {
            return redirect()->route('cursos.index')->withErrors(['error_negocio' => $e->getMessage()]);
        }
    }

    public function update(CursoStoreRequest $request, int $id)
    {
        try {
            $this->cursoService->actualizarCurso($id, $request->validated());
            return redirect()->route('cursos.index')->with('success', '¡Curso actualizado correctamente!');
        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error_negocio' => $e->getMessage()]);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->cursoService->eliminarCurso($id);
            return redirect()->route('cursos.index')->with('success', 'El curso ha sido eliminado del catálogo.');
        } catch (Exception $e) {
            return redirect()->route('cursos.index')->withErrors(['error_negocio' => $e->getMessage()]);
        }
    }
}
