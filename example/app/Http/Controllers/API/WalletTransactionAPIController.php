<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateWalletTransactionAPIRequest;
use App\Http\Requests\API\UpdateWalletTransactionAPIRequest;
use App\Models\WalletTransaction;
use App\Repositories\WalletTransactionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class WalletTransactionAPIController
 */
class WalletTransactionAPIController extends AppBaseController
{
    private WalletTransactionRepository $walletTransactionRepository;

    public function __construct(WalletTransactionRepository $walletTransactionRepo)
    {
        $this->walletTransactionRepository = $walletTransactionRepo;
    }

    /**
     * Display a listing of the WalletTransactions.
     * GET|HEAD /wallet-transactions
     */
    public function index(Request $request): JsonResponse
    {
        $walletTransactions = $this->walletTransactionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($walletTransactions->toArray(), 'Wallet Transactions retrieved successfully');
    }

    /**
     * Store a newly created WalletTransaction in storage.
     * POST /wallet-transactions
     */
    public function store(CreateWalletTransactionAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $walletTransaction = $this->walletTransactionRepository->create($input);

        return $this->sendResponse($walletTransaction->toArray(), 'Wallet Transaction saved successfully');
    }

    /**
     * Display the specified WalletTransaction.
     * GET|HEAD /wallet-transactions/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var WalletTransaction $walletTransaction */
        $walletTransaction = $this->walletTransactionRepository->find($id);

        if (empty($walletTransaction)) {
            return $this->sendError('Wallet Transaction not found');
        }

        return $this->sendResponse($walletTransaction->toArray(), 'Wallet Transaction retrieved successfully');
    }

    /**
     * Update the specified WalletTransaction in storage.
     * PUT/PATCH /wallet-transactions/{id}
     */
    public function update($id, UpdateWalletTransactionAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var WalletTransaction $walletTransaction */
        $walletTransaction = $this->walletTransactionRepository->find($id);

        if (empty($walletTransaction)) {
            return $this->sendError('Wallet Transaction not found');
        }

        $walletTransaction = $this->walletTransactionRepository->update($input, $id);

        return $this->sendResponse($walletTransaction->toArray(), 'WalletTransaction updated successfully');
    }

    /**
     * Remove the specified WalletTransaction from storage.
     * DELETE /wallet-transactions/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var WalletTransaction $walletTransaction */
        $walletTransaction = $this->walletTransactionRepository->find($id);

        if (empty($walletTransaction)) {
            return $this->sendError('Wallet Transaction not found');
        }

        $walletTransaction->delete();

        return $this->sendSuccess('Wallet Transaction deleted successfully');
    }
}
