<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Tarefa\StoreTarefaRequest;
use App\Http\Requests\V1\Tarefa\UpdateTarefaRequest;
use App\Http\Resources\V1\Tarefa\TarefaCollection;
use App\Http\Resources\V1\Tarefa\TarefaResource;
use App\Models\Tarefa;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class TarefaController extends Controller
{
    public function index(): TarefaCollection
    {
        return new TarefaCollection(Auth::user()->tarefas()->paginate());
    }

    public function store(StoreTarefaRequest $request): TarefaResource
    {
        return new TarefaResource(Tarefa::create($request->all()));
    }

    /**
     * @throws AuthorizationException
     */
    public function show(Tarefa $tarefa): TarefaResource
    {
        if (!Auth::user()->can('view', $tarefa))
        {
            throw new AuthorizationException();
        }
      return new TarefaResource($tarefa);
    }

    public function update(UpdateTarefaRequest $request, Tarefa $tarefa): void
    {
        $tarefa->update($request->all());
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Tarefa $tarefa): void
    {
        if (!Auth::user()->can('delete', $tarefa))
        {
            throw new AuthorizationException();
        }
        $tarefa->delete();
    }

}
