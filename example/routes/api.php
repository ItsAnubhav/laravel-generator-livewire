



Route::resource('wallet-transactions', App\Http\Controllers\API\WalletTransactionAPIController::class)
    ->except(['create', 'edit']);