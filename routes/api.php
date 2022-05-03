<?php


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PermissionController;
use App\Http\Controllers\Client\ClientsController;
use App\Http\Controllers\Dashboard\AnalyticsController;
use App\Http\Controllers\Debtor\DebtorsController;
use App\Http\Controllers\Expense\ExpensesController;
use App\Http\Controllers\Factory\FactoriesController;
use App\Http\Controllers\Factory\FactoryCategoriesController;
use App\Http\Controllers\Factory\FactoryIncomesController;
use App\Http\Controllers\Factory\FactoryProductsController;
use App\Http\Controllers\Finance\FinanceController;
use App\Http\Controllers\Order\OrderExtraProductsController;
use App\Http\Controllers\Order\OrderIncomesController;
use App\Http\Controllers\Order\OrdersController;
use App\Http\Controllers\Product\ProductCategoriesController;
use App\Http\Controllers\Product\ProductIncomesController;
use App\Http\Controllers\Product\ProductsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Sale\SalesController;
use App\Http\Controllers\Sewing\SewingReportsController;
use App\Http\Controllers\Storage\StoragesController;
use App\Http\Controllers\Storage\StorageTypesController;
use App\Http\Controllers\User\UsersController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::apiResource('/permissions', PermissionController::class);
    Route::apiResource('product-categories', ProductCategoriesController::class);
    Route::apiResource('factory-categories', FactoryCategoriesController::class);
    Route::apiResource('products', ProductsController::class);
    Route::apiResource('product-income', ProductIncomesController::class);
    Route::apiResource('factories', FactoriesController::class);
    Route::apiResource('factory-income', FactoryIncomesController::class);
    Route::apiResource('factory-product', FactoryProductsController::class);
    Route::apiResource('storage-types', StorageTypesController::class);
    Route::apiResource('order', OrdersController::class);
    Route::apiResource('order-income', OrderIncomesController::class);
    Route::apiResource('storage', StoragesController::class);
    Route::apiResource('sales', SalesController::class);
    Route::apiResource('expense', ExpensesController::class);
    Route::apiResource('users', UsersController::class);
    Route::apiResource('clients', ClientsController::class);
    Route::apiResource('debtors', DebtorsController::class);
    Route::apiResource('order-extra-product', OrderExtraProductsController::class);
    Route::apiResource('role', RoleController::class);

    //Outsource Mato va Yoqa to'quv Buyurtmalarim edit and delete
    Route::put('order-update-sewed/{id}', [OrdersController::class, 'orderUpdateSewed']);
    Route::delete('order-delete-sewed/{id}', [OrdersController::class, 'orderDeleteSewed']);

    //Ta'minot bichuv Bichuv tarixi edit and delete
    Route::put('history-update-sewed/{id}', [SewingReportsController::class, 'historyUpdateSewed']);
    Route::delete('history-delete-sewed/{id}', [SewingReportsController::class, 'historyDeleteSewed']);

    //Profile image login name password update
    Route::post('image-upload', [UsersController::class, 'imageUpload']);
    Route::post('update-login', [UsersController::class, 'updateLoginAndName']);
    Route::post('update-password', [UsersController::class, 'updatePassword']);

    Route::post('order-product', [OrderIncomesController::class, 'getOrderReadyProduct']);
    //skladdan boshqa to'quvxonaga mahsulot o'tkazish
    Route::post('transfer-product', [FactoryProductsController::class, 'transferProduct']);
    //Bo'yoqxonaga product yuborish
    Route::post('order-product-painting', [OrdersController::class, 'sendingProductPainting']);
    //Bo'yoqxonadan ranglangan mahsulotni olish
    Route::post('product-painting', [OrderIncomesController::class, 'getProductPainting']);
    //Ta'minot/Ta'minot/Bichuv/Mahsulot bichildi
    Route::post('product-sewed', [ProductsController::class, 'getExchangeRawToProduct']);
    //Ta'minot/Bichuv Buyurtma berish modalka
    Route::post('order-sewing', [OrdersController::class, 'sendingProductSewing']);
    //Fabrika/Qo'shimcha berish modalka
    Route::post('get-extra-product', [OrderExtraProductsController::class, 'getExtraProduct']);
    //Fabrika/Mahsulot olindi modalka
    Route::post('get-ready-product', [OrderIncomesController::class, 'getReadyProduct']);
    //Fabrika/Yopilgan buyurtmalar
    Route::post('finished-order', [OrdersController::class, 'setFinishedOrder']);
    //Moliya/Qarzdorlik/Summani kiriting
    Route::post('paid-order-income', [FinanceController::class, 'paidOrderIncome']);
    //Moliya/Qarzdorlik/Summani kiriting
    Route::post('paid-sale-product', [FinanceController::class, 'paidOrderIncome']);
    //Moliya/Qarzdorlik/Product qarzdorlik
    Route::post('paid-product-income', [FinanceController::class, 'paidProductIncome']);

    // filter factory, product_case=raw,painting,sewed,ready search
    Route::get('get-factory-product-thread', [FactoryProductsController::class, 'getFactoryProductThread']);
    //Omborxona/ Ip Kirim
    Route::get('product-income-thread', [ProductIncomesController::class, 'getProductThread']);
    //Omborxona/Ip Mavjud Iplar
    Route::get('get-storage-thread', [StoragesController::class, 'getStorageThread']);
    //Omborxona/Mavjud Matolar
    Route::get('get-storage-material', [StoragesController::class, 'getStorageMaterial']);
    //Omborxona/ Yoqa Mavjud iplar
    Route::get('get-storage-product', [StoragesController::class, 'getStorageProduct']);
    //Omborxona/Ip Jarayondagi iplar
    Route::get('get-process-thread', [FactoryIncomesController::class, 'getProcessThread']);
    //Omborxona/Yoqa status=3 Mato status=2 Jarayondagi iplar
    Route::get('get-process-product', [FactoryIncomesController::class, 'getProcessProduct']);
    //Omborxona/Mato Jarayondagi iplar
    Route::get('get-process-material', [FactoryIncomesController::class, 'getProcessMaterial']);
    //Omborxona/Mato Yoqa Kirim
    Route::get('income-storage-product', [OrderIncomesController::class, 'getStorageIncomeOrder']);
    //Omborxona/Mato Yoqa Chiqim
    Route::get('outgoing-storage-product', [OrdersController::class, 'getStorageOutgoingProduct']);
    //Ta'minot/Accessory Kirim
    Route::get('product-income-accessory', [ProductIncomesController::class, 'getProductAccessory']);
    //Outsource/Mato to'quv buyurtma berishdagi productlar filter
    Route::get('product-filtered', [ProductsController::class, 'getProductFilteredParentId']);
    //Ta'minot/Tayyor xomashyo/Mato va Yoqa Kirim
    Route::get('ready-raw', [OrderIncomesController::class, 'getReadyRaw']);
    //Ta'minot/Tayyor xomashyo/Mavjud tayyor Mato va Yoqa
    Route::get('storage-painted-product', [StoragesController::class, 'getStoragePaintedProduct']);
    //Ta'minot/Bichuv Bichuv tarixi
    Route::get('history-sewed', [SewingReportsController::class, 'getHistorySewed']);
    //Ta'minot/Bichuv Bichilgan mahsulot omborxonasi
    Route::get('sewed-storage', [StoragesController::class, 'getStorageSewed']);
    //Ta'minot/Bichuv Buyurtma tarixi
    Route::get('sewing-process-history', [FactoryIncomesController::class, 'getSewingProcess']);
    //Ta'minot/Chiqim Mato, Yoqa, Accessory
    Route::get('supply-product', [OrderExtraProductsController::class, 'getSupplyExtraProduct']); //Todo change
    //Fabrika/Hozirgi jarayon
    Route::get('factory-sewing-history', [OrdersController::class, 'getFilteredFactorySewingHistory']);
    //Tayyor mahsulotlar/ Mavjud mahsulotlar
    Route::get('storage-ready-product', [StoragesController::class, 'getReadyStorageProduct']);
    //Tayyor mahsulotlar/ Kirim
    Route::get('ready-order-income', [OrderIncomesController::class, 'getReadyOrderIncome']);
    //Ta'minot/Bichuv Bichilgan mahsulot omborxonasi filtered parent_category
    Route::get('filtered-sewed-storage', [StoragesController::class, 'getStorageFilteredSewed']);
    //Umumiy
    Route::get('dashboard-analytics', [AnalyticsController::class, 'getDashboardAnalytics']);
    //Umumiy chart analytic
    Route::get('dashboard-chart-analytics', [AnalyticsController::class, 'getDashboardChartAnalytics']);
    //Umumiy skladdagi productlar
    Route::get('dashboard-analytic-product', [AnalyticsController::class, 'getDashboardProductAnalytics']);
    //Umumiy fabrikalar qarzdorlik
    Route::get('dashboard-analytic-factory', [AnalyticsController::class, 'getDashboardFactoryAnalytics']);
    //Moliya kirim
    Route::get('finance-income', [FinanceController::class, 'getFinanceIncome']);
    //Moliya Qarzdorlik analytics
    Route::get('finance-analytics', [FinanceController::class, 'getDebtAnalytics']);
    //Moliya Qarzdorlik table
    Route::get('finance-factory-debt', [FinanceController::class, 'getFactoryDebt']);
    //Moliya Qarzdorlik sewed  table
    Route::get('finance-factory-sewed', [FinanceController::class, 'getFactorySewedDebt']);
    //Moliya Chiqim
    Route::get('outgoing-payment', [FinanceController::class, 'getOutgoingPayments']);
    //Moliya Chiqim
    Route::get('product-income-payments', [FinanceController::class, 'getProductIncomePayments']);
    //Moliya Chiqim sewing
    Route::get('sewing-payments', [FinanceController::class, 'getSewingPayments']);
    //Moliya Chiqim xarajat
    Route::get('expense-payments', [FinanceController::class, 'getExpenses']);
    //Rollar
    Route::get('roles', [UsersController::class, 'getRoles']);
    //Hamma chiqimlar
    Route::get('all-expenses', [FinanceController::class, 'getAllExpenses']);
    //Product debtors
    Route::get('product-debtors', [FinanceController::class, 'getProductDebtor']);
});
