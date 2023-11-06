<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreTarefaRequest;
use App\Http\Requests\V1\UpdateTarefaRequest;
use App\Http\Resources\V1\TarefaCollection;
use App\Http\Resources\V1\TarefaResource;
use App\Models\Tarefa;

class TarefaController extends Controller
{
    public function index(): TarefaCollection
    {
        return new TarefaCollection(Tarefa::paginate());
    }

    public function store(StoreTarefaRequest $request): TarefaResource
    {
        return new TarefaResource(Tarefa::create($request->all()));
    }

    public function show(Tarefa $tarefa): TarefaResource
    {
      return new TarefaResource($tarefa);
    }

    public function update(UpdateTarefaRequest $request,  Tarefa $tarefa): void
    {
        $tarefa->update($request->all());
    }

    public function destroy(Tarefa $tarefa): void
    {
        $tarefa->delete();
    }

}
