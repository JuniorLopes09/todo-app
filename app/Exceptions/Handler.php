<?php

namespace App\Exceptions;


use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    private function formatModelName($model): string
    {
        $parts = explode('\\', $model);
        return end($parts);
    }

    private function getGender($model): string
    {
        return str_ends_with($model, 'a') ? 'a' : 'o';
    }
    public function render($request, \Throwable $e): Response
    {
        if ($e instanceof ModelNotFoundException)
        {
            $model = $this->formatModelName($e->getModel());
            $gender = $this->getGender($model);
            return response()->json(['message' => "$model não encontrad$gender"], Response::HTTP_NOT_FOUND);
        }
        elseif ($e instanceof AuthorizationException) {
            return response()->json(['message' => "Usuário não autorizado"], Response::HTTP_UNAUTHORIZED);
        }
        elseif ($e instanceof AuthenticationException) {
            return response()->json(['message' => "Usuário não autenticado"], Response::HTTP_UNAUTHORIZED);
        }

        return parent::render($request, $e);
    }



}
