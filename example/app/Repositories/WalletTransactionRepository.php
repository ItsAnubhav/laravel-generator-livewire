<?php

namespace App\Repositories;

use App\Models\WalletTransaction;
use App\Repositories\BaseRepository;

class WalletTransactionRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'type',
        'amount',
        'opening_balance',
        'closing_balance',
        'remarks'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return WalletTransaction::class;
    }
}
