<?php

namespace App\Http\Resources\V1\Tarefa;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TarefaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
