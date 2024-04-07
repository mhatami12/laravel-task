<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;


class BaseApiController extends Controller
{
    protected $statusCode = 200;

    protected function respondSuccess(
        $data = ['message' => 'OK'],
        $code = 200,
        ?callable $callback = null
    ): JsonResponse {
        return $this->respond($code, 'OK', $data, $callback);
    }

    /**
     * @param            $message
     * @param int|null   $statusCode
     * @param array|null $errors     custom validation errors bag
     *
     * @return JsonResponse
     */
    public function respondWithError($message, int $statusCode = null, array $errors = null): JsonResponse
    {
        $statusCode = $this->getStatusCode();
        $errors     = ['general' => [$message]];

        return $this->respond($statusCode, $message, [
            'errors'  => $errors,
        ]);
    }

    /**
     * @param int $code
     * @param string $message
     * @param string[] $data
     * @param callable|null $callback
     * @return JsonResponse
     */
    protected function respond(
        int $code = 200,
        string $message = 'OK',
        $data = ['message' => 'OK'],
        ?callable $callback = null
    ): JsonResponse {
        $response = new JsonResponse($data);
        $response->setStatusCode($code, $message);

        if ($callback) {
            $callback($response);
        }

        return $response;
    }

    /**
     * @param int $statusCode
     *
     * @return self
     */
    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
