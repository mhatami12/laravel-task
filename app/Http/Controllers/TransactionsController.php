<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Log;
use Throwable;

class TransactionsController extends BaseApiController
{

    protected $service;

    /**
     * TransactionsController constructor.
     *
     * @param TransactionService $service
     */
    public function __construct(TransactionService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
       return $this->respondSuccess(new TransactionResource($this->service->Transactions()));
    }


    /**
     * @param TransactionRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws Throwable
     */
    public function store(TransactionRequest $request)
    {
        $payload = $request->only([
            'amount'
        ]);

        $payload['type'] = $request->segment(count(request()->segments()));

        try {
            $transaction = $this->service->newTransaction($payload);
        } catch (Throwable $exception) {
            Log::critical(
                $exception->getMessage()
            );
            return $this->respondWithError('Transaction creation failed.',503);
        }

        $statusCode = $payload['type'] == 'mobile' ? 201 : 200;

        return $this->respondSuccess(['transaction_id' => $transaction->id, 'created_at' => $transaction->created_at], $statusCode);
    }

}
