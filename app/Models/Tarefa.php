<?php

namespace App\Models;

use App\Observers\TarefaObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'concluida'];

    protected $attributes = [
        'concluida' => 0
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        self::observe(TarefaObserver::class);
    }
}
