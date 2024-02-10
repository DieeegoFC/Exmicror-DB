<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\PackagingDetailsController;
use App\Http\Controllers\BarcodeLabelsController;
use App\Http\Controllers\ComplianceRegulationsController;
use App\Http\Controllers\DistributionClientsController;
use App\Http\Controllers\SpecialOffersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductInventoryController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\ReturnsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-db-connection', function () {
    try {
        DB::connection()->getPdo();
        return "¡Conexión exitosa!";
    } catch (\Exception $e) {
        return "Error de conexión: " . $e->getMessage();
    }
});

Route::get('/packaging', [PackagingDetailsController::class, 'index']);
Route::get('/packaging/create', [PackagingDetailsController::class, 'create']);
Route::post('/packaging', [PackagingDetailsController::class, 'store']);
Route::get('/packaging/{id}/edit', [PackagingDetailsController::class, 'edit']);
Route::put('/packaging/{id}', [PackagingDetailsController::class, 'update']);
Route::delete('/packaging/{id}', [PackagingDetailsController::class, 'destroy']);

Route::get('/barcodeLabels', [BarcodeLabelsController::class, 'index']);
Route::get('/barcodeLabels/create', [BarcodeLabelsController::class, 'create']);
Route::post('/barcodeLabels', [BarcodeLabelsController::class, 'store']);
Route::get('/barcodeLabels/{id}/edit', [BarcodeLabelsController::class, 'edit']);
Route::put('/barcodeLabels/{id}', [BarcodeLabelsController::class, 'update']);
Route::delete('/barcodeLabels/{id}', [BarcodeLabelsController::class, 'destroy']);

Route::get('/complianceRegulations', [ComplianceRegulationsController::class, 'index']);
Route::get('/complianceRegulations/create', [ComplianceRegulationsController::class, 'create']);
Route::post('/complianceRegulations', [ComplianceRegulationsController::class, 'store']);
Route::get('/complianceRegulations/{id}/edit', [ComplianceRegulationsController::class, 'edit']);
Route::put('/complianceRegulations/{id}', [ComplianceRegulationsController::class, 'update']);
Route::delete('/complianceRegulations/{id}', [ComplianceRegulationsController::class, 'destroy']);

Route::get('/distributionClients', [DistributionClientsController::class, 'index']);
Route::get('/distributionClients/create', [DistributionClientsController::class, 'create']);
Route::post('/distributionClients', [DistributionClientsController::class, 'store']);
Route::get('/distributionClients/{id}/edit', [DistributionClientsController::class, 'edit']);
Route::put('/distributionClients/{id}', [DistributionClientsController::class, 'update']);
Route::delete('/distributionClients/{id}', [DistributionClientsController::class, 'destroy']);

Route::get('/specialOffers', [SpecialOffersController::class, 'index']);
Route::get('/specialOffers/create', [SpecialOffersController::class, 'create']);
Route::post('/specialOffers', [SpecialOffersController::class, 'store']);
Route::get('/specialOffers/{id}/edit', [SpecialOffersController::class, 'edit']);
Route::put('/specialOffers/{id}', [SpecialOffersController::class, 'update']);
Route::delete('/specialOffers/{id}', [SpecialOffersController::class, 'destroy']);

Route::get('/orders', [OrdersController::class, 'index']);
Route::get('/orders/create', [OrdersController::class, 'create']);
Route::post('/orders', [OrdersController::class, 'store']);
Route::get('/orders/{id}/edit', [OrdersController::class, 'edit']);
Route::put('/orders/{id}', [OrdersController::class, 'update']);
Route::delete('/orders/{id}', [OrdersController::class, 'destroy']);

Route::get('/invoices', [InvoicesController::class, 'index']);
Route::get('/invoices/create', [InvoicesController::class, 'create']);
Route::post('/invoices', [InvoicesController::class, 'store']);
Route::get('/invoices/{id}/edit', [InvoicesController::class, 'edit']);
Route::put('/invoices/{id}', [InvoicesController::class, 'update']);
Route::delete('/invoices/{id}', [InvoicesController::class, 'destroy']);

Route::get('/productInventory', [ProductInventoryController::class, 'index']);
Route::get('/productInventory/create', [ProductInventoryController::class, 'create']);
Route::post('/productInventory', [ProductInventoryController::class, 'store']);
Route::get('/productInventory/{id}/edit', [ProductInventoryController::class, 'edit']);
Route::put('/productInventory/{id}', [ProductInventoryController::class, 'update']);
Route::delete('/productInventory/{id}', [ProductInventoryController::class, 'destroy']);

Route::get('/customerProfiles', [CustomerProfileController::class, 'index']);
Route::get('/customerProfiles/create', [CustomerProfileController::class, 'create']);
Route::post('/customerProfiles', [CustomerProfileController::class, 'store']);
Route::get('/customerProfiles/{id}/edit', [CustomerProfileController::class, 'edit']);
Route::put('/customerProfiles/{id}', [CustomerProfileController::class, 'update']);
Route::delete('/customerProfiles/{id}', [CustomerProfileController::class, 'destroy']);

Route::get('/returns', [ReturnsController::class, 'index']);
Route::get('/returns/create', [ReturnsController::class, 'create']);
Route::post('/returns', [ReturnsController::class, 'store']);
Route::get('/returns/{id}/edit', [ReturnsController::class, 'edit']);
Route::put('/returns/{id}', [ReturnsController::class, 'update']);
Route::delete('/returns/{id}', [ReturnsController::class, 'destroy']);