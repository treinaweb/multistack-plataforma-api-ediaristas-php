<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

trait ApiHandler
{
    /**
     * Trata as exceções da nossa API
     *
     * @param \Throwable $e
     * @return JsonResponse
     */
    protected function getJsonException(\Throwable $e): JsonResponse
    {
        if ($e instanceof ValidationException) {
            return $this->validationException($e);
        }

        return $this->genericException($e);
    }

    /**
     * Retornar uma resposta para erro de validação
     *
     * @param ValidationException $e
     * @return JsonResponse
     */
    protected function validationException(ValidationException $e): JsonResponse
    {
        return resposta_padrao(
            "Erro de validação dos dados enviados", 
            "validation_error", 
            400, 
            $e->errors()
        );
    }

    /**
     * Retorna uma resposta para erro genérico
     *
     * @param \Throwable $e
     * @return JsonResponse
     */
    protected function genericException(\Throwable $e): JsonResponse
    {
        return resposta_padrao("erro interno no servidor", "internal_error", 500);
    }
}