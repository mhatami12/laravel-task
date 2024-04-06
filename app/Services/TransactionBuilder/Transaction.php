<?php


namespace App\Services\TransactionBuilder;


use App\Models\WebService;

class Transaction
{
    protected $amount;
    protected $type;
    protected $webService;

    /**
     * Transaction constructor.
     * @param $amount
     * @param $type
     * @param WebService $webService
     */
    public function __construct($amount, $type, WebService $webService)
    {
        $this->amount = $amount;
        $this->type = $type;
        $this->webService = $webService;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return WebService
     */
    public function getWebService(): WebService
    {
        return $this->webService;
    }

    /**
     * @param WebService $webService
     */
    public function setWebService(WebService $webService): void
    {
        $this->webService = $webService;
    }


}
