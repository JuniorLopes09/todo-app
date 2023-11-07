<?php

namespace App\Observers;

use App\Models\Tarefa;
use Illuminate\Support\Facades\Auth;

class TarefaObserver
{
    public function creating(Tarefa $tarefa): void
    {
        $tarefa->user_id = Auth::id();
    }
}
