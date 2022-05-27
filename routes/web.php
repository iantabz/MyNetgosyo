<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'layouts.app');

Auth::routes();

Route::middleware(['auth'])->group(function () {


    Route::prefix('user')->group(function () {
        Route::post('add_new_user', 'HomeController@store');

        Route::get('getUser', 'HomeController@getAllUsers');
        Route::get('getUser/users', 'HomeController@searchUser');

        Route::get('getUserAcct', 'HomeController@getAllUsersAcct');
        Route::get('getUserAcct/usersAcct', 'HomeController@searchUserAcct');

        Route::get('getAdmin', 'HomeController@getAdmins');
        Route::get('getAdmin/admin', 'HomeController@searchAdmin');

        Route::get('getHepedeViaje', 'HomeController@getHepedeViaje');
        Route::get('getHepedeViaje/hepedeviaje', 'HomeController@searchHepedeViaje');

        Route::get('getSalesman', 'HomeController@getSalesmans');
        Route::get('getSalesman/salesman', 'HomeController@searchSalesman');

        Route::get('getCustomer', 'HomeController@getCustomers');
        Route::get('getCustomer/customer', 'HomeController@searchCustomer');

        Route::get('get_month', 'HomeController@getMonth');
        Route::get('get_year', 'HomeController@getYear');

        // kaloy 2022-05-27
        Route::post('/change-password', 'HomeController@changePassword');
    });

    Route::prefix('consolidated')->group(function () {
        Route::get('getConsolidated', 'ConsolidatedTransactionController@getConsolidated');
        Route::get('getConsolidated/consolidated', 'ConsolidatedTransactionController@searchConsolidated');

        // kaloy 2021-11-10
        // for generating S.I. test data
        Route::post('generate_si_test', 'ConsolidatedTransactionController@generateSITest');

        // kaloy 2022-05-05
        Route::post('/add-is-manual-items', 'ConsolidatedTransactionController@addIsManualItems');
    });

    Route::prefix('item')->group(function () {

        //item vue with img
        Route::post('saved_item_image', 'ItemMasterfileController@store_image');
        Route::get('getItem', 'ItemMasterfileController@getListItems');
        Route::get('getItem/item', 'ItemMasterfileController@searchItem');
        Route::get('activate_item', 'ItemMasterfileController@activate');

        //item vue without img
        Route::post('saved_item_image1', 'ItemMasterfileController@store_image');
        Route::get('getItem1', 'ItemMasterfileController@getListItems1');
        Route::get('getItem1/item1', 'ItemMasterfileController@searchItem1');
        Route::get('activate_item1', 'ItemMasterfileController@activate');

        //upload vue
        Route::get('getItem2', 'ItemMasterfileController@getListItems2');
        Route::get('getItem2/item2', 'ItemMasterfileController@searchItemu');
        Route::get('activate_item2', 'ItemMasterfileController@activate');

        Route::get('getNoItem', 'ItemMasterfileController@getListNoItems');
        Route::get('getNoItem/noitem', 'ItemMasterfileController@searchNoItem');
        Route::get('drop_noitem', 'ItemMasterfileController@dropItem');

        //Returned items
        Route::get('getReturnedItems', 'ItemMasterfileController@getReturnedItems');
        Route::get('getReturnedItems1', 'ItemMasterfileController@print');
        Route::get('getReturnedItems2', 'ItemMasterfileController@transaction');
        Route::get('getReturnedItems/item_returned', 'ItemMasterfileController@searchReturnedItems');

        //Unserved Items
        Route::get('getUnservedItems', 'ItemMasterfileController@getReturnedItemsnaUnserved');
        Route::get('getUnservedItems/item', 'ItemMasterfileController@searchUnservedItems');
        Route::get('getUnservedItems/print', 'ItemMasterfileController@printUnserved');

        //upload history log
        Route::get('getItemLog', 'ItemHistoryLogController@getListItemsLog');
        Route::get('getItemLog/item_log', 'ItemHistoryLogController@searchItemLog');
        Route::get('getItemDetailsLog/itemlogdetail', 'ItemHistoryLogController@detailsLog');

        Route::get('getOrderItem', 'ItemMasterfileController@getCategoryItem');
        Route::get('getOrderItem/item3', 'ItemMasterfileController@searchCategoryItem');
    });

    Route::prefix('messenger')->group(function () {
        Route::get('/', 'MessengerController@index');
        Route::get('retrieve/{contactCode}/{contactRef}', 'MessengerController@retrieveMessages');
        Route::post('/', 'MessengerController@sendMessage');
        Route::get('deactivate_chat', 'MessengerController@deactivateChat');
        Route::post('create_new_chat', 'MessengerController@createNewChat');
    });

    Route::prefix('tele_ordering')->group(function () {

        //categories
        Route::get('get_categories', 'SalesOrderController@getCategories');
        Route::get('get_customers', 'SalesOrderController@getCustomers');

        Route::get('getTransaction', 'SalesOrderController@getAddTransaction');
        Route::get('getTransaction/addtrans', 'SalesOrderController@searchAddTrans');

        Route::post('additionalOrder', 'SalesOrderController@store');
        Route::get('cancelOrder', 'SalesOrderController@cancelOrder');

        Route::get('getCustomerInfo', 'SalesOrderController@getCustomerInfo');
    });

    Route::prefix('cut_off_time')->group(function () {
        Route::post('set_time_cutoff', 'SalesExportFilesController@setCutoffTime');
        Route::get('get_time_setup', 'SalesExportFilesController@getTimeSetup');
    });

    Route::prefix('transaction')->group(function () {

        //transaction
        Route::get('getTransaction', 'TransactionController@getTransaction');
        Route::get('getTransaction1', 'TransactionController@getTransaction1');
        Route::get('getTransaction2', 'TransactionController@getTransaction2');
        Route::get('getTransaction3', 'TransactionController@getTransaction3');
        Route::get('getTransaction4', 'TransactionController@getTransaction4');
        Route::get('getTransaction5', 'TransactionController@getTransaction5');
        Route::get('getTransaction6', 'TransactionController@getTransaction6');
        Route::get('getTransaction7', 'TransactionController@getTransaction7');
        Route::get('getTransaction/transaction', 'TransactionController@searchTransaction');
        Route::get('getTransaction/transaction1', 'TransactionController@searchTransaction1');
        Route::get('getTransaction/transaction2', 'TransactionController@searchTransaction2');
        Route::get('getTransaction/transaction3', 'TransactionController@searchTransaction3');
        Route::get('getTransaction/transaction4', 'TransactionController@searchTransaction4');
        Route::get('getTransaction/transaction5', 'TransactionController@searchTransaction5');
        Route::get('getTransaction/transaction6', 'TransactionController@searchTransaction6');
        Route::get('getTransaction/transaction7', 'TransactionController@searchTransaction7');
        Route::get('getOrderTransaction/order_detail', 'TransactionController@getOrderDetails');
        Route::get('getOrderTransaction/teleorder_detail', 'TransactionController@getTeleOrderDetails');

        Route::get('getOrder', 'TransactionController@getOrder');
        Route::get('getOrder/order', 'TransactionController@searchOrder');
        Route::get('getOrderTransaction1/order_detail1', 'TransactionController@getOrder1');

        Route::get('getTotalAmount', 'TransactionController@getTotalAmount');
        Route::get('getTotalAmountDel', 'TransactionController@getTotalAmountDel');
        Route::get('getTotalAmountRet', 'TransactionController@getTotalAmountRet');
        Route::get('getTotalAmountCanc', 'TransactionController@getTotalAmountCanc');
        Route::get('getTotalAmountAdv', 'TransactionController@getTotalAmountAdv');
        Route::get('getTotalAll', 'TransactionController@getTotalAmountAll');
        Route::get('getTotalSubmitted', 'TransactionController@getTotalAmountSubmitted');
        Route::get('getTotalOnProcess', 'TransactionController@getTotalAmountOnProcess');
        Route::get('getTotalApproved', 'TransactionController@getTotalAmountApproved');
        Route::get('getTotalDelivered', 'TransactionController@getTotalAmountDelivered');
        Route::get('getTotalReturned', 'TransactionController@getTotalAmountReturned');
        Route::get('getTotalCancelled', 'TransactionController@getTotalAmountCancelled');
        Route::get('getTotalAdvanced', 'TransactionController@getTotalAmountAdvanced');

        // kaloy 2021-10-05
        Route::get('get-ongoing-transactions-count', 'TransactionController@getOngoingTransactionsCount');
        Route::get('advanced-orders-count', 'TransactionController@advancedOrdersCount');

        // kaloy 2021-11-10
        // revert transaction util
        Route::post('revert-transaction', 'TransactionController@revertTransaction');
        // delete transaction util 2021-11-11
        Route::post('delete-transaction', 'TransactionController@deleteTransaction');
        
        // kaloy 2022-05-27
        Route::post('qty-adjustment', 'TransactionController@qtyAdjustment');
    });

    Route::prefix('export')->group(function () {

        //transaction
        Route::get('getExportBcom', 'SalesExportFilesController@getBcom');
        Route::get('getExportBcom/bcom', 'SalesExportFilesController@searchBcom');

        Route::get('getExportAris', 'SalesExportFilesController@getAris');
        Route::get('getExportAris/aris', 'SalesExportFilesController@searchAris');

        Route::get('get_export_files_bcom', 'SalesExportFilesController@export');
        Route::get('get_export_files_bulk', 'SalesExportFilesController@export2');
        // Route::get('get_export_files_flowrack', 'SalesExportFilesController@export3');
        Route::get('get_export_files_flowrack', 'SalesExportFilesController@transaction');

        Route::get('get_export_files_bcom_unserved', 'SalesExportFilesController@export_unserved_bcom');
        Route::get('get_export_files_bulk_unserved', 'SalesExportFilesController@export_unserved_bulk');
        Route::get('get_export_files_flowrack_unserved', 'SalesExportFilesController@transaction_unserved_flowrack');

        Route::get('get_export_files_aris', 'SalesExportFilesController@export_aris');

        Route::get('getExportBulk', 'SalesExportFilesController@getBulk');
        Route::get('getOrder/bulk', 'SalesExportFilesController@searchBulk');

        Route::get('getExportUnserved', 'SalesExportFilesController@getUnserved');
        Route::get('getExportUnserved/unserved', 'SalesExportFilesController@searchUnserved');
    });

    Route::post('/import_masterfile', 'ItemMasterfileController@item_masterfile_import');
    Route::post('/import_csv_masterfile', 'ItemMasterfileController@item_csv_masterfile_import');
    Route::post('/import_consolidated_masterfile', 'ConsolidatedTransactionController@consolidated_masterfile_import');
    Route::get('/get_updated_list_item', 'ItemMasterfileController@getListUpdatedItem');
    Route::get('/get_unupdatedlist_item', 'ItemMasterfileController@getListUnUpdatedItem');

    Route::prefix('customer')->group(function () {
        Route::post('/create_customeraccnt', 'CustomerMasterFileController@store');
        Route::post('/activate_customer', 'CustomerMasterFileController@activate');
        Route::get('/api/persons/all', 'CustomerMasterFileController@get');
        Route::get('/person/{customer_id}', 'CustomerMasterFileController@getCustomer');
        Route::post('/get_account_details', 'CustomerMasterFileController@get_account_details');
        Route::get('/getCustomers', 'CustomerMasterFileController@getCustomers');
        Route::get('/getCustomers2', 'CustomerMasterFileController@getCustomers2');
        Route::get('/getCustomers2/customer', 'CustomerMasterFileController@searchCustomer');
        Route::post('/update_customeraccnt', 'CustomerMasterFileController@updateCustomer');
        Route::post('/import/customer', 'CustomerMasterFileController@importCust')->name('customer_import');
        Route::get('/getSalesmanCode', 'CustomerMasterFileController@show');
        Route::post('/getSalesmanDetails', 'CustomerMasterFileController@getSalesmanDetails');
        Route::post('/postCredit', 'CustomerMasterFileController@postCredit');
        Route::post('/setDefaultPassword', 'CustomerMasterFileController@setDefaultPassword');

        Route::get('/get_principal', 'CustomerMasterFileController@get_principal');
        Route::get('/get_principal/name', 'CustomerMasterFileController@searchSupplier');
        Route::post('/postDiscount', 'CustomerMasterFileController@postDiscount');
        Route::get('/getPList', 'CustomerMasterFileController@getPList');
        Route::get('/getPList/name', 'CustomerMasterFileController@searchPList');
        Route::post('/tagPList', 'CustomerMasterFileController@tagPList');
        Route::get('/forPrint', 'CustomerMasterFileController@forPrint');
    });

    Route::prefix('account_group_codes')->group(function () {
        Route::post('/create_group_code', 'AccountGroupCodeController@store');
        Route::get('/get_account_group_codes', 'AccountGroupCodeController@getGroupCodes');
        Route::delete('/delete_group_codes/{id}', 'AccountGroupCodeController@destroy');
    });

    Route::prefix('salesman')->group(function () {
        Route::get('/get_salesman_list', 'SalesmanListController@getSalesman');
        Route::post('/create_salesman', 'SalesmanListController@create');
        Route::post('/activate_salesman', 'SalesmanListController@activate');
        Route::get('/getAssignSalesmanCustomerList', 'SalesmanListController@getAssignSalesmanCustomerList');
        Route::get('/getAssignSalesmanCustomerList/customer', 'SalesmanListController@searchAssignSalesmanCustomerList');
        Route::post('/tagCustomertoSalesman', 'SalesmanListController@tagCustomertoSalesman');
        Route::post('/untagCustomertoSalesman', 'SalesmanListController@untagCustomertoSalesman');
        Route::get('/getSalesmanCustomerList', 'SalesmanListController@getSalesmanCustomerList');
        Route::get('/getSalesmanCustomerList/customer', 'SalesmanListController@searchSalesmanCustomerList');
        Route::post('/getMaxCode', 'SalesmanListController@getMaxCode');
        Route::post('/changePword', 'SalesmanListController@changePword');
        Route::get('/getMunicipality', 'SalesmanListController@getMunicipality');
        Route::get('/forPrint', 'SalesmanListController@forPrint');
        Route::get('/getAddress', 'SalesmanListController@getAddress');
        Route::get('/exportCustomerList', 'SalesmanListController@exportCustomerList');
    });


    Route::post('/create_usertype', 'TblUsertypeController@store');
    Route::get('/getUserTypes', 'TblUserTypeController@index');

    Route::prefix('salesman_route')->group(function () {
        Route::get('/getSalesman', 'SalesmanRouteController@getSalesman');
        Route::get('/getTownList', 'SalesmanRouteController@getTownList');
        Route::get('/salesman/{salesman_id}', 'SalesmanRouteController@getSalesmanRoutes');
        Route::post('/postSchedule', 'SalesmanRouteController@postSchedule');
        Route::get('/print', 'SalesmanRouteController@print');
    });

    Route::prefix('hepedeviaje')->group(function () {
        Route::post('/create_hepe', 'HepeDeViajeController@create_hepe');
        Route::get('/get_hepe', 'HepeDeViajeController@get_hepe');
        Route::get('/get_hepe/name', 'HepeDeViajeController@search_hepe');
        Route::get('/getAssignHepeSalesmanList', 'HepeDeViajeController@getAssignHepeSalesmanList');
        Route::get('/getAssignHepeSalesmanList/customer', 'HepeDeViajeController@searchAssignSalesmanCustomerList');
        Route::get('/getHepeSalesmanList', 'HepeDeViajeController@getHepeSalesmanList');
        Route::get('/getHepeSalesmanList/customer', 'HepeDeViajeController@searchHepeSalesmanList');
        Route::post('/tagSalesmanToHepe', 'HepeDeViajeController@tagSalesmanToHepe');
        Route::post('/activate_hepe', 'HepeDeViajeController@activate_hepe');
        Route::get('/getSalesmanLogs', 'HepeDeViajeController@getSalesmanLogs');
    });

    Route::get('/getCustomerRequests', 'CustomerRequestController@getCustomerRequests');
    Route::get('/getCustomerRequests/customers', 'CustomerRequestController@searchCustomerRequests');
    Route::get('/getCustomerRequests/date', 'CustomerRequestController@searchCustomerRequestsbyDate');
    Route::get('/getApprovedCustomers/date', 'CustomerRequestController@searchApprovedCustomersbyDate');
    Route::post('/approveCustomer', 'CustomerRequestController@approveCustomer');
    Route::get('/getApprovedCustomers', 'CustomerRequestController@getApprovedCustomers');
    Route::get('/getApprovedCustomers/customers', 'CustomerRequestController@searchApprovedCustomers');
    Route::post('/rejectCustomer', 'CustomerRequestController@rejectCustomer');
    Route::get('/getRejectedCustomers', 'CustomerRequestController@getRejectedCustomers');
    Route::get('/getRejectedCustomers/customers', 'CustomerRequestController@searchRejectedCustomers');
    Route::post('/importitemsbulk', 'ImportBulkController@importitemsbulk');
    Route::get('/getItemsBulk', 'ImportBulkController@getItemsBulk');
    Route::get('/getItemsBulk/item', 'ImportBulkController@searchItemsBulk');
    Route::post('/importItemsFlowrack', 'ImportFlowrackController@importItemsFlowrack');
    Route::post('/importItemsBCOM', 'ImportBCOMController@importItemsBCOM');
    Route::get('/getItemsBCOM', 'ImportBCOMController@getItemsBCOM');
    Route::get('/getItemsBCOM/item', 'ImportBCOMController@searchItemsBCOM');
    Route::get('/getItemsFlowrack', 'ImportFlowrackController@getItemsFlowrack');
    Route::get('/getItemsFlowrack/item', 'ImportFlowrackController@searchItemsFlowrack');
    Route::get('/exportCustomerRequest', 'CustomerRequestController@exportCustomerRequest');
    Route::post('/approvedBy', 'CustomerRequestController@approvedBy');

    Route::prefix('principal')->group(function () {
        Route::post('/create_supplier', 'TblPrincipalController@create_supplier');
        Route::get('/get_supplier', 'TblPrincipalController@get_supplier');
        Route::get('/get_supplier/name', 'TblPrincipalController@searchSupplier');
        Route::post('/toggleSupplier', 'TblPrincipalController@toggleSupplier');
        Route::get('/get_supplier/dis', 'TblPrincipalController@searchDis');
        Route::post('/postDiscount', 'TblPrincipalController@postDiscount');
    });

    Route::prefix('discount')->group(function () {
        Route::get('/getItems', 'TblDiscount@getItems');
        Route::get('/getItems/name', 'TblDiscount@searchItems');
        Route::get('/getItems/withCategory', 'TblDiscount@getItems');
        Route::post('/postDiscount', 'TblDiscount@postDiscount');
    });

    Route::prefix('salesreport')->group(function () {
        Route::get('/getSalesman', 'SalesReportController@getSalesman');
        Route::get('/getCustomer', 'SalesReportController@getCustomer');
        Route::get('/selectAll', 'SalesReportController@selectAll');
        Route::get('/customer', 'SalesReportController@getTransaction');
        Route::get('/ptype', 'SalesReportController@ptype');
        Route::get('/ptypeAll', 'SalesReportController@ptypeAll');
        Route::get('/printReport', 'SalesReportController@printReport');
        Route::get('/printReport2', 'SalesReportController@printReport2');

        Route::get('/getJepe', 'SalesReportController@getJepe');
        Route::get('/getJepeSales', 'SalesReportController@getJepeSales');
        Route::prefix('salesReportJepe')->group(function () {
            Route::get('/printSummary', 'SalesReportController@printSummary');
        });

        Route::get('/getOrderHistory', 'SalesReportController@getOrderHistory');
        Route::get('/printOrderHistory', 'SalesReportController@printOrderHistory');
    });

    Route::prefix('topReports')->group(function () {
        Route::get('/topProducts', 'TopReports@topProducts');
        Route::get('/topProducts/search', 'TopReports@topProducts');
        Route::get('/printTopProducts', 'TopReports@printTopProducts');

        Route::get('/topCustomers', 'TopReports@topCustomers');
        Route::get('/topCustomers/search', 'TopReports@topCustomers');
        Route::get('/printTopCustomer', 'TopReports@printTopCustomer');

        Route::get('/topSalesman', 'TopReports@topSalesman');
        Route::get('/topSalesman/search', 'TopReports@topSalesman');
        Route::get('/printTopSalesman', 'TopReports@printTopSalesman');

        Route::get('/topJepe', 'TopReports@topJepe');
        Route::get('/topJepe/search', 'TopReports@topJepe');
        Route::get('/printTopJepe', 'TopReports@printTopJepe');

        Route::get('/totalOrderCount', 'TopReports@totalOrderCount');
        Route::get('/printTotalOrderCount', 'TopReports@printTotalOrderCount');

        Route::get('/sourceOrderCount', 'TopReports@sourceOrderCount');
        Route::get('/printsourceOrderCount', 'TopReports@printsourceOrderCount');
    });

    Route::prefix('viewingUsers')->group(function () {
        Route::get('getviewingUsers', 'ViewingUsersController@getviewingUsers');
        Route::post('toggleStatus', 'ViewingUsersController@toggleStatus');
        Route::post('newViewingUser', 'ViewingUsersController@newViewingUser');
        Route::post('/getMaxCode', 'ViewingUsersController@getMaxCode');
    });

    Route::prefix('feedbacks')->group(function () {
        Route::get('getResults', 'FeedBackController@getResults');
    });

    // Route::get('sample', function () {
    //     return view('sample');
    // });
    Route::get('/getAuthUser', 'HomeController@getAuthUser');
    Route::post('/import_masterfile/import', 'ItemMasterfileController@item_masterfile_import')->name('import_file');

    // kaloy 2022-03-09
    Route::group(['prefix' => 'fixes'], function () {
        Route::get('/restore-lost-trans', 'Fixes\RestoreLostTrans@index');
    });

    // kaloy 2022-04-05
    Route::post('/grouped-items-upload', 'ImportGroupedItemsController@groupedItemsUpload');

    // kaloy 2022-04-27
    // Dashboard
    Route::get('/average-transactions-per-day','DashboardController@averageTransactionsPerDay');

    // Price Changes
    Route::post('/upload-price-changes','PriceChangesController@uploadPriceChanges');
});



Route::get('{any}', 'HomeController@index')->where('any', '.*');
