<?php

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

use App\Http\Controllers\CommercialInvoiceController;

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home','ReportController@index');
    Route::get('/', 'ReportController@index');
    Route::get('/report', 'ReportController@index');
    Route::post('/new_remarks', 'RemarkController@store');
    Route::post('/update_remarks/{id}', 'RemarkController@update');
    Route::post('/notifications/mark-as-read/{id}', 'NotificationController@markAsRead')->name('notifications.markAsRead');



    Route::get('/gp-report','GPReportController@index');

    Route::get('/monthly_sales', 'MonthlySalesController@index');

    // WHI
    // SOA Sharp
    Route::get('/whi_soa_list', 'PrinController@soa_index');
    Route::post('/soa_usa_commercial', 'PrinController@soa_usa_commercial');
    Route::post('/soa_eur_commercial', 'PrinController@soa_eur_commercial');
    Route::post('/soa_php_commercial', 'PrinController@soa_php_commercial');
    
    // Credit Note 
    Route::get('/credit_note', 'PrinController@whi_credit_note_index');
    Route::post('/save_credit_note', 'PrinController@save_credit_note');
    Route::get('/credit_note_internal/{id}', 'PrinController@credit_note_internal_print');
    Route::post('/edit_credit_note/{id}', 'PrinController@edit_credit_note');

    // WHI BIR
    Route::post('/bir_commercial_invoice', 'PrinController@whi_bir_commercial_invoice');
    Route::get('/whi_bir_invoice', 'CommercialInvoiceController@index');
    
    Route::post('/save_as_new_invoice', 'CommercialInvoiceController@save_as_new_invoice');
    Route::post('/edit_new_invoice/{id}', 'CommercialInvoiceController@edit_new_invoice');
    Route::get('/bir_original_commercial_invoice/{invoice_number}', 'CommercialInvoiceController@original_print')->name('bir_original_invoice');
    Route::get('/bir_original_unique_commercial_invoice/{invoice_number}', 'CommercialInvoiceController@original_print')->name('bir_original_unique_invoice');
    Route::get('/bir_original_unique_commercial_vatable_invoice/{invoice_number}', 'CommercialInvoiceController@original_print')->name('bir_original_unique_vatable_invoice');
    Route::get('/bir_original_unique_commercial_exempt_invoice/{invoice_number}', 'CommercialInvoiceController@original_print')->name('bir_original_unique_exempt_invoice');

    Route::get('/bir_original_commercial_vatable_invoice/{invoice_number}', 'CommercialInvoiceController@original_print')->name('bir_original_vatable_invoice');
    Route::get('/bir_original_commercial_exempt_invoice/{invoice_number}', 'CommercialInvoiceController@original_print')->name('bir_original_exempt_invoice');
    Route::get('/whi_bir_edited_commercial_invoice/{DocNum}', 'CommercialInvoiceController@edit_print')->name('whi_bir_edited_commercial_invoice');
    Route::get('/whi_bir_edited_commercial_vatable_invoice/{DocNum}', 'CommercialInvoiceController@edit_print')->name('whi_bir_edited_commercial_vatable_invoice');
    Route::get('/whi_bir_edited_commercial_exempt_invoice/{DocNum}', 'CommercialInvoiceController@edit_print')->name('whi_bir_edited_commercial_exempt_invoice');

    Route::post('/billing_statement_trade', 'PrinController@billing_statement')->name('billing_statement_trade');
    Route::get('/billing_statement_list', 'PrinController@billing_statement_non_trade_list');
    Route::post('/billing_statement_non_trade', 'PrinController@billing_statement')->name('billing_statement_non_trade');
    Route::post('/save_as_new_non_trade', 'PrinController@save_as_new_invoice');
    Route::post('/edit_new_non_trade_invoice/{id}', 'PrinController@edit_new_invoice');

    Route::get('/billing_statement_non_trade_print/{id}', 'PrinController@billing_statement_non_trade_print');


    Route::get('/credit_note_bir/{id}', 'PrinController@credit_note_bir_print');

    // PBI
    Route::post('/soa_eur_commercial_pbi', 'PrinController@soa_eur_commercial_pbi');
    Route::post('/soa_php_commercial_pbi', 'PrinController@soa_php_commercial_pbi');

    // PBI BIR
    Route::get('/pbi_bir_invoice', 'CommercialInvoiceController@index');
    Route::get('/pbi_bir_original_commercial_invoice/{invoice_number}', 'CommercialInvoiceController@pbi_original_print')->name('pbi_bir_original_invoice');
    Route::get('/pbi_bir_original_commercial_vatable_invoice/{invoice_number}', 'CommercialInvoiceController@pbi_original_print')->name('pbi_bir_original_commercial_vatable_invoice');
    Route::get('/pbi_bir_original_commercial_exempt_invoice/{invoice_number}', 'CommercialInvoiceController@pbi_original_print')->name('pbi_bir_original_commercial_exempt_invoice');
    Route::get('/pbi_bir_edited_commercial_invoice/{DocNum}', 'CommercialInvoiceController@edit_print')->name('pbi_bir_edited_commercial_invoice');
    Route::get('/pbi_bir_edited_commercial_vatable_invoice/{DocNum}', 'CommercialInvoiceController@edit_print')->name('pbi_bir_edited_commercial_vatable_invoice');
    Route::get('/pbi_bir_edited_commercial_exempt_invoice/{DocNum}', 'CommercialInvoiceController@edit_print')->name('pbi_bir_edited_commercial_exempt_invoice');
    Route::post('/pbi_save_as_new_invoice', 'CommercialInvoiceController@save_as_new_invoice');
    Route::post('/pbi_edit_new_invoice/{id}', 'CommercialInvoiceController@edit_new_invoice');
    Route::delete('/delete-product/{id}', 'CommercialInvoiceController@deleteProduct');
    Route::get('/pbi_bir_invoice_special', 'CommercialInvoiceController@index_special');
    Route::get('/pbi_bir_edited_commercial_invoice_special/{DocNum}', 'CommercialInvoiceController@edit_print')->name('pbi_bir_edited_commercial_invoice_special');


    // Debit Memo
    Route::get('/pbi_debit_memo', 'DebitMemoController@index');
    Route::post('/save_debit_memo_pbi', 'DebitMemoController@pbi_save_debit_memo');
    Route::get('/print_debit_note/{id}', 'DebitMemoController@pbi_print_debit_memo');
    Route::post('/edit_debit_memo_pbi/{id}', 'DebitMemoController@edit_debit_memo');

    // Credit Note
    Route::get('/pbi_credit_note', 'PrinController@pbi_credit_note_index');
    Route::post('/save_credit_note_pbi', 'PrinController@pbi_save_credit_note');
    Route::post('/edit_credit_note_pbi/{id}', 'PrinController@pbi_edit_credit_note');
    Route::get('/pbi_print_credit_note/{id}', 'PrinController@pbi_print_credit_note');

    // CCC

    // Credit Note
    Route::get('/credit_note_ccc', 'PrinController@ccc_credit_note_index');
    Route::post('/save_credit_note_ccc', 'PrinController@ccc_save_credit_note');
    Route::post('/edit_credit_note_ccc/{id}', 'PrinController@ccc_edit_credit_note');
    Route::get('/credit_note_internal_ccc/{id}', 'PrinController@ccc_credit_note_internal_print');

    // BIR CCC
    Route::get('/ccc_bir_invoice', 'CommercialInvoiceController@index');
    Route::get('/ccc_bir_original_commercial_invoice/{invoice_number}', 'CommercialInvoiceController@ccc_original_print')->name('ccc_bir_original_invoice');
    Route::post('/save_as_new_invoice_ccc', 'CommercialInvoiceController@save_as_new_invoice_ccc');
    Route::post('/edit_new_invoice_ccc/{id}', 'CommercialInvoiceController@edit_new_invoice_ccc');
    Route::get('/bir_edited_commercial_invoice/{DocNum}', 'CommercialInvoiceController@edit_print')->name('ccc_bir_edited_invoice');

    Route::get('/ccc_bir_sales_invoice', 'CommercialInvoiceController@sales_invoice_index');
    Route::get('/ccc_bir_original_sales_invoice_vatable/{invoice_number}', 'CommercialInvoiceController@ccc_original_sales_invoice_print')->name('ccc_bir_original_sales_invoice_vatable');
    Route::get('/ccc_bir_original_sales_invoice_zero_rate/{invoice_number}', 'CommercialInvoiceController@ccc_original_sales_invoice_print')->name('ccc_bir_original_sales_invoice_zero_rate');
    Route::post('/billing_statement_ccc', 'PrinController@billing_statement_ccc');


    
});