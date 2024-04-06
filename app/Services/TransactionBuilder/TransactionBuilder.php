<?php


namespace App\Services\TransactionBuilder;


class TransactionBuilder
{
    /**
     * @var Transaction
     */
    private $transaction;

    /**
     * TransactionBuilder constructor.
     * @param $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * @param Transaction $transaction
     * @return TransactionBuilder
     */
    public static function forge(Transaction $transaction):TransactionBuilder
    {
        return new TransactionBuilder($transaction);
    }

    /**
     * @return mixed
     */
    public function build()
    {
        return  \App\Models\Transaction::create([
            'amount' => $this->transaction->getAmount(),
            'type' => $this->transaction->getType(),
            'webservice_id' => $this->transaction->getWebService()->id,
        ]);
    }
}
