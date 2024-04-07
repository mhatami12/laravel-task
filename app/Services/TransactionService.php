<?php


namespace App\Services;

use App\Classes\Utils\Monetary;
use App\Models\WebService;
use App\Services\TransactionBuilder\Transaction;
use App\Services\TransactionBuilder\TransactionBuilder;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    /**
     * @param array $data
     * @return mixed
     */
    public function newTransaction(array $data)
    {
        $typeId = $this->getPlatformId($data['type']);

        /** @var  WebService $webService */
        $webService = isset($data['type']) ? WebService::where(['name' => $typeId])->first() : null;

        $transaction = new Transaction(
            $this->currentAmount($data['type'], $data['amount']),
            $typeId,
            $webService
        );

        return TransactionBuilder::forge($transaction)->build();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function Transactions()
    {
        return DB::table('transactions')
            ->selectRaw('
                   COUNT(CASE WHEN amount BETWEEN 0 AND 4999 THEN 1 END) AS count_0_to_5000,
                   COUNT(CASE WHEN amount BETWEEN 5000 AND 9999 THEN 1 END) AS count_5000_to_10000,
                   COUNT(CASE WHEN amount BETWEEN 10000 AND 99999 THEN 1 END) AS count_10000_to_100000,
                   COUNT(CASE WHEN amount > 100000 THEN 1 END) AS count_10000_to_up,
                   SUM(amount) AS amount,
                   COUNT(CASE WHEN type = 0 THEN 1 END) AS web_count,
                   COUNT(CASE WHEN type = 1 THEN 1 END) AS mobile_count,
                   COUNT(CASE WHEN type = 2 THEN 1 END) AS pos_count
            ')->first();
    }

    /**
     * @param $type
     * @return int|null
     */
    private function getPlatformId($type): ?int
    {
        $id = null;
        switch ($type) {
            case 'pos':
                $id = 2;
                break;
            case 'mobile':
                $id = 1;
                break;
            case 'web':
                $id = 0;
                break;
            default:
                logger('WRONG TYPE !!!');
        }
        return $id;
    }

    /**
     * @param $type
     * @param $amount
     * @return int|mixed
     */
    private function currentAmount($type, $amount)
    {
        return in_array($type, ['web', 'mobile']) ? Monetary::convertToRial($amount) : (int)$amount;
    }
}
