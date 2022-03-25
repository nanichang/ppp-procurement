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

Route::get('/', function () {
    return redirect()->route('login');
   // return view('welcome');
});

Auth::routes();

Route::post('/login', "AuthenticationController@login")->name('post_login');

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/logout', 'HomeController@logout')->name('logout');


//Contractor
Route::get('/contractor/registration', 'ContractorController@registration')->name('contractor_registration');
Route::post('/contractor/create', 'ContractorController@storeContractor')->name('contractor_storeCompany');
Route::get('/contractor/adverts', 'PlanAdvertController@getPublishedAdverts');
Route::get('/contractor/uploaded/documents',  'ContractorController@getUploadedDocuments')->name('getUploadedDcument');
Route::get('/contractor/transactions/',  'ContractorController@getTransactions')->name('transactionsList');
Route::get('/contractor/awards', 'AwardController@contractorAwards')->name('contractor.awards');
Route::get('/contractor/awards/{id}', 'AwardController@contractorAward')->name('contractor.award');


Route::get('/logout', 'HomeController@logout')->name('logout');
// Route::get('/contractor/reports', 'ContractorController@reportsContractor')->name('contractor_reports');

//Compliance
Route::post('/compliance/create', 'ComplianceController@storeCompliance')->name('storeCompliance');
Route::get('/compliance/list', 'ComplianceController@getCompliance')->name('getCompliance');

//Director
Route::post('/director/create', 'DirectorController@storeDirector')->name('storeDirector');
Route::get('/director/directors', 'DirectorController@directors')->name('returnDirector');
Route::post('/director/delete', 'DirectorController@deleteDirector')->name('deleteDirector');

//ContractorCategory
Route::post('/category/create', 'ContractorCategoryController@storeCategory');
Route::post('/category/delete', 'ContractorCategoryController@deleteCategory');
Route::get('/category/categories', 'ContractorCategoryController@categories')->name('returnCategories');

//ContractorPersonnel
Route::post('/personnel/create', 'ContractorPersonnelController@storePersonnel');
Route::get('/personnel/personnels', 'ContractorPersonnelController@personnels')->name('returnPersonnel');
Route::post('/personnel/delete', 'ContractorPersonnelController@deletePersonnel')->name('deletePersonnel');

//contractorJobs
Route::post('/job/create', 'ContractorJobsController@storeJob');
Route::get('/job/jobs', 'ContractorJobsController@getJobs')->name('returnJobs');
Route::post('/job/delete', 'ContractorJobsController@deleteJob')->name('deleteJob');

//contractorFinance
Route::post('/finance/create', 'ContractorFinanceController@storeFinance');
Route::get('/finance/finances', 'ContractorFinanceController@getFinances')->name('returnFinances');
Route::post('/finance/delete', 'ContractorFinanceController@deleteFinance')->name('deleteFinance');

//contractorMachinery
Route::post('/machinery/create', 'ContractorMachineryController@storeMachinery');
Route::get('/machinery/machineries', 'ContractorMachineryController@getMachineries')->name('returnMachineries');
Route::post('/machinery/delete', 'ContractorMachineryController@deleteMachinery')->name('deleteMachinery');

//Admin

//Route::resource('manageMDA', 'MDAController');

// Route::post('/mda/create', 'MDAController@storeMdas')->name('storeMdas');
// Route::post('/mda/delete', 'MDAController@deleteMda')->name('deleteMdas');
// Route::get('/mda/list', 'MDAController@getMdas')->name('getMdas');
// Route::get('/mad/{id}', 'MDAController@mdasPreview')->name('mdasPreview');

//MDA
Route::get('/mda/adverts', 'PlanAdvertController@getMDAAdverts')->name('listMdaAdverts');
Route::get('/mda/adverts/bidopening', 'PlanAdvertController@getMDAOpeningAdverts')->name('listMdaBidOpeningAdverts');
Route::get('/mda/adverts/category/{Id}', 'PlanAdvertController@getMDAAdvertsByCategory');
Route::get('/mda/awards', 'AwardController@mdaAwards')->name('mda.awards');

//Admin ADverts
Route::get('/admin/adverts', 'PlanAdvertController@getAllAdverts')->name('listAllAdverts');
Route::get('/admin/adverts/category/{Id}', 'PlanAdvertController@getAllAdvertsByCategory')->name('getAllAdvertsByCategory');
Route::get('/admin/awards', 'AwardController@adminAwards')->name('admin.awards');

Route::get('/mda/createAdvert', 'MDAController@createAdvert')->name('newMdaAdvert');
Route::get('/contractors/report', 'ReportController@contractors')->name('contractorReport');
/////
Route::post('/contractors/activate/{id}/{value}', 'ContractorController@editContractorStatus')->name('contractorAccount');


Route::get('/contractors/{id}', 'ReportController@contractorPreview')->name('contractorPreview');
Route::get('/mda/advert/bidrequirement/{advertId}/', 'MDAController@bidRequirements')->name('bidRequirements');
Route::post('/mda/create', 'MDAController@storeMdas')->name('storeMdas');
Route::post('/mda/delete', 'MDAController@deleteMda')->name('deleteMdas');
Route::get('/mda/list', 'MDAController@getMdas')->name('getMdas');
Route::get('/mad/{id}', 'MDAController@mdasPreview')->name('mdasPreview');
Route::get('/mda/advert/preview/{advertId}', 'MDAController@getMDAAdvertById');

Route::get('/mda/procurement-plan/preview/{mda_id}', 'ProcurementPlanController@viewSubmittedPlans')->name('viewSubmittedPlans');
Route::post('/mda/procurement-plan/approve/', 'ProcurementPlanController@approvePlan')->name('procurementPlan.approvePlan');

Route::get('/mda/procurement/{plan_id}/create-advert', 'PlanAdvertController@create')->name('create-plan-advert');
Route::post('/mda/procurement/{plan_id}/create-advert', 'PlanAdvertController@store')->name('create-plan-advert.store');

Route::post('/mda/procurement/create-advert-criteria', 'PlanAdvertController@addCriteria')->name('create-advert-criteria.addCriteria');

Route::post('/mda/procurement/delete-advert-criteria', 'PlanAdvertController@deleteCriteria')->name('deleteAdvertCriteria');

Route::post('/mda/procurement/delete-advert-document', 'PlanAdvertController@deleteAdvertDocument')->name('deleteAdvertDocument');

Route::get('/mda/procurement/plan-adverts/{id}/preview', 'PlanAdvertController@show')->name('create-plan-advert.preview');
Route::post('/mda/procurement/plan-adverts/{id}/preview/approve', 'PlanAdvertController@approveAdvert')->name('create-plan-advert.approveAdvert');
Route::post('/advert/delete', 'PlanAdvertController@deleteAdvert')->name('deletePlanAdvert');
Route::post('/mda/procurement/plan-adverts/{id}/preview/disapprove', 'PlanAdvertController@disapproveAdvert')->name('create-plan-advert.disapproveAdvert');
Route::post('/mda/procurement/plan-adverts/plan-advert-criteria', 'PlanAdvertController@submitContractorCriterea')->name('submitContractorCriterea');
// Route::match(['get', 'post'], '/mda/contractor/award-contract', 'PlanAdvertController@awardContract')->name('award-contract-to-contractor');
//Route::get('/admin/adverts/', 'PlanAdvertController@getAdverts')->name('adminAdverts');
Route::get('/admin/adverts/opening', 'PlanAdvertController@getAllOpeningAdverts');

Route::get('/mda/adverts/preview/{advertId}', 'MDAController@getMDAAdvertById')->name('mdaAdPublicationPage');
Route::get('/admin/adverts/preview/{advertId}', 'MDAController@viewAdvertById')->name('adminAdPublicationPage');

Route::get('/contractor/adverts/preview/{advertId}', 'MDAController@viewContractorAdvertById')->name('contractor.bid.preview');
Route::get('/mda/open/{advertId}', 'MDAController@viewAdvertOpeningById')->name('viewAdvertOpeningById');
Route::match(['get', 'post'], '/mda/show/submitted-lots', 'MDAController@viewSubmittedLots')->name('viewSubmittedLots');
Route::match(['get', 'post'], '/mda/show/submitted-lot/view', 'MDAController@viewSingleSubmittedLot')->name('viewSingleSubmittedLot');
Route::post('/contractor/payment-document', 'SalesController@uploadPaymentDocument')->name('payment_document');
Route::post('/contractor/tender-document', 'SalesController@uploadContractorTenderDocument')->name('contractor_tender_document');

Route::match(['get', 'post'], '/user/profile')->name('showEvaluatorInvitePage');
//Adverts
Route::post('/advert/create', 'AdvertController@storeAdvert')->name('storeAdvert');
Route::get('/advert/adverts/{planId}', 'PlanAdvertController@adverts')->name('returnAdverts');
//Route::post('/advert/delete', 'AdvertController@deleteAdvert')->name('deleteAdvert');
Route::get('/advert/active/preview/{advertId}', 'AdvertController@getAdvertById')->name('returnAds');
Route::post('/advert/update/', 'PlanAdvertController@updateAdvert');
// Route::get('/adverts/preview/{advertId}', 'AdvertController@getSubmittedAdvertById');
Route::get('/contractor/adverts/preview/{advertId}', 'PlanAdvertController@getPublishedAdvertById');

Route::post('/admin/advert/{advertId}/{status}', 'PlanAdvertController@toggleAdvert');
Route::get('/contractor/adverts/category/{Id}', 'PlanAdvertController@getPublishedAdvertsByCategory');

//AdvertLot
Route::post('/advert-lot/create', 'AdvertLotController@storeAdvertLot')->name('storeAdvertLot');
Route::get('/advert-lot/advertLots', 'AdvertLotController@advertLots')->name('returnAdvertLots');
Route::post('/advert-lot/deleteAdvertLot', 'AdvertLotController@deleteAdvertLot')->name('deleteAdvertLot');

//bidsRequirement
Route::post('/bidRequirement/create/', 'TenderRequirementController@storeTenderRequirement')->name('storeRequirement');
Route::get('/bidRequirement/requirements/{lotId}', 'TenderRequirementController@tenderRequirement')->name('returnRequirements');
Route::post('/bidRequirement/delete', 'TenderRequirementController@deleteAdvert')->name('deleteRequirements');


// bids eligibility
Route::post('/admin/requirement/create', 'TenderEligibilityController@storeName')->name('storeName');
Route::get('/admin/requirement/names', 'TenderEligibilityController@index')->name('getEligibility');
Route::post('/admin/requirement/delete/', 'TenderEligibilityController@delete')->name('deleteName');

// ownership structure
Route::post('/ownership/structure/create', 'OwnershipStructureController@storeOwnershipStructure')->name('storeOwnershipStructure');
Route::get('/ownership/structures', 'OwnershipStructureController@getOwnershipStructure')->name('getOwnershipStructure');
Route::get('/ownership', 'OwnershipStructureController@index')->name('getOwnership');
Route::post('/ownership/delete/', 'OwnershipStructureController@delete')->name('ownership.delete');

// Equipments
Route::post('/equipment/type/create', 'EquipmentController@storeEquipments')->name('storeEquipments');
Route::get('/equipment/types', 'EquipmentController@getEquipmentsType')->name('getEquipmentsType');
Route::get('/equipments', 'EquipmentController@index')->name('getEquipments');
Route::post('/equipment/delete/', 'EquipmentController@delete')->name('equipment.delete');

// Registration Fee
Route::post('/registration/fee/create', 'CategoryRegistrationFeeController@storeFee')->name('storeFee');
//Route::get('/fee/fees', 'ContractorRegistrationFeeController@getEquipmentsType')->name('getEquipmentsType');
Route::get('/fee/fees', 'CategoryRegistrationFeeController@index')->name('getFees');
Route::post('/fee/delete/', 'CategoryRegistrationFeeController@delete')->name('deleteFees');

// Business Categories
Route::post('/business-category/create', 'BusinessCategoryController@storeBusinessCategory')->name('storeBusinessCategory');
Route::get('/business/categories', 'BusinessCategoryController@getAllBusinessCategories')->name('getAllBusinessCategories');
Route::get('/business/business-categories', 'BusinessCategoryController@index')->name('fetchBusinessCategories');
Route::post('/business-category/delete/', 'BusinessCategoryController@delete')->name('deleteBusinessCategory');


//Advert Types
Route::post('/advert-type/create', 'AdvertTypeController@storeAdvertType')->name('storeAdvertType');
Route::get('/advert-type/types', 'AdvertTypeController@getAllAdvertTypes')->name('getAllAdvertTypes');
Route::get('/advert/advert-types', 'AdvertTypeController@index')->name('fetchAdvertTypes');
Route::post('/advert-type/delete/', 'AdvertTypeController@delete')->name('deleteAdvertType');


//Advert Mode
Route::post('/advert-mode/start', 'AdvertModeController@storeAdvertMode')->name('storeAdvertMode');
Route::get('/advert-mode/types', 'AdvertModeController@getAllAdvertModes')->name('getAllAdvertModes');
Route::get('/advert-mode/modes', 'AdvertModeController@index')->name('fetchAdvertModes');
Route::post('/advert-mode/delete/', 'AdvertModeController@delete')->name('deleteAdvertMode');




// Business sub Categories 1
Route::get('/business/subcategory1', 'BusinessSubCategory1Controller@getAllBusinessSubCategories')->name('getAllBusinessSubCategories');
Route::post('business/sub-category/create', 'BusinessSubCategory1Controller@storeBusinessCategory')->name('storeBusinessSubCategory');
Route::get('/business/sub-categories', 'BusinessSubCategory1Controller@index')->name('fetchBusinessSubCategories');
Route::post('business/sub-category/delete/', 'BusinessSubCategory1Controller@delete')->name('deleteBusinessSubCategory');

// Business sub Categories 2
Route::get('/business/subcategory2', 'BusinessSubCategory2Controller@getAllBusinessSubCategories')->name('getAllBusinessSubCategories2');

// Countries
Route::get('/countries', 'CountryController@getAllCountries')->name('getAllCountries');

// States
Route::get('/states', 'CountryController@getAllStates')->name('getAllStates');

Route::post('/contractor/upload', 'ContractorController@uploadContractorFile')->name('uploadContractorFile');
Route::post('/contractor/upload/delete', 'ContractorController@deleteContractorFile')->name('deleteContractorFile');
Route::get('/contractor/files', 'ContractorController@getDocumentsByUserId')->name('contractorFiles');
Route::get('/contractor/download/reg-category/','ContractorController@getIRR')->name('getIRR');
Route::get('/contractor/downloadPDF/{registrationId}','ContractorController@downloadPDF')->name('downloadPdf');
Route::get('/contractor/tender/apply/{advertId}','ContractorController@getAdvertById');
Route::post('password/update', 'ContractorController@updatePassword');
Route::get('contractor/change/password', 'ContractorController@getPasswordUpdate');
Route::post('/contractor/registration/finish', 'ContractorController@completeRegistration');

// PDF Name
Route::post('/admin/pdf/create', 'PDFCertificateNameController@storeName')->name('storePDFName');
Route::get('/admin/pdf/names', 'PDFCertificateNameController@index')->name('getPDFNames');
Route::post('/admin/pdf/delete/', 'PDFCertificateNameController@delete')->name('deletePDFName');

// Company Ownership
Route::get('/company/ownership/list', 'CompanyOwnershipController@index')->name('companyOwnership');
Route::get('/company/ownership', 'CompanyOwnershipController@getCompanyOwnership')->name('getCompanyOwnership');
Route::post('/company/ownership/store', 'CompanyOwnershipController@storeCompanyOwnership')->name('storeCompanyOwnership');

// Employment Type
Route::get('/employment/type', 'EmploymentTypeController@getAllEmploymentType')->name('getAllEmploymentType');

// qualifications
Route::get('/qualifications', 'QualificationController@getQualifications')->name('getQualifications');
Route::post('/qualifications/store', 'QualificationController@storeQualifications')->name('storeQualifications');
Route::get('/qualifications/list', 'QualificationController@index')->name('qualifications');
Route::post('/qualifications/delete/', 'QualificationController@delete')->name('qualifications.delete');

//sales
Route::get('/sales/list', 'SalesController@getSalesByUserId')->name('getSales');
Route::post('/sales/store', 'SalesController@storeSales')->name('storesales');
Route::get('/bid/pdf/{advertId}', 'SalesController@getSalesByUserandAdvert')->name('purchases');
Route::get('/bids/purchasedDocuments/', 'SalesController@getSalesByUser')->name('getPurchasedBidsByUser');
Route::get('/bids/bidDocuments/', 'SalesController@getBidDocumentsByUser')->name('getbidDocumentsByUser');
Route::get('/bid/downloadPDF/{salesId}','SalesController@downloadPDF')->name('getPdf');

// Transactions
Route::get('/mda/transactions/','SalesController@getMDATransactions')->name('transactions');
Route::post('mda/close_payment/{id}','SalesController@updatePaymentStatus')->name('updateTransactions');
Route::get('mda/change/password', 'MDAController@getPasswordUpdate');


Route::group(['prefix' => 'procurement-year'], function() {
    Route::get('/', 'ProcurementYearController@index')->name('procurementYear.index');
    Route::post('/', 'ProcurementYearController@store')->name('procurementYear.store');

    Route::post('/delete', 'ProcurementYearController@delete')->name('procurementYear.delete');

    Route::get('/disable-year/{id}', 'ProcurementYearController@disable')->name('procurementYear.disable');
    Route::get('/enable-year/{id}', 'ProcurementYearController@enable')->name('procurementYear.enable');
});

Route::group(['prefix' => 'procurement-type'], function() {
    Route::get('/', 'ProcurementPlanController@index')->name('procurementPlan.index');
    Route::post('/', 'ProcurementPlanController@store')->name('procurementPlan.store');

    Route::match(['GET', 'POST'], '/create', 'ProcurementPlanController@createPlan')->name('procurementPlan.create');
    Route::match(['GET', 'POST'], '/viewing-all/{year?}', 'ProcurementPlanController@viewAll')->name('procurementPlan.viewall');

    Route::get('/edit/{id}', 'ProcurementPlanController@edit')->name('procurementPlan.edit');
    Route::patch('/edit/{id}', 'ProcurementPlanController@update')->name('procurementPlan.update');
    Route::get('/{id}/delete', 'ProcurementPlanController@delete')->name('procurementPlan.delete');

    Route::post('/{id}/delete', 'ProcurementPlanController@delete')->name('procurementPlan.delete');
});

Route::group(['prefix' => 'registration-payment'], function() {
    Route::get('/payment', 'RegistrationPaymentController@create')->name('contractor.registration.create');
    Route::post('/payment', 'RegistrationPaymentController@store')->name('contractor.registration.store');

    Route::get('/contractors/payment', 'RegistrationPaymentController@contractors')->name('contractor.registration.index');

    Route::post('/contractors/payment/approve', 'RegistrationPaymentController@approve')->name('registration.payment.approve');
});

Route::group(['prefix' => 'adverts-payment'], function() {
    Route::get('/payment', 'AdvertPaymentController@create')->name('advert.payment.create');
    Route::post('/payment', 'AdvertPaymentController@store')->name('advert.payment.store');
});


Route::group(['prefix' => 'evaluators'], function () {
    // Route::get('/', 'EvaluatorController@index')->name('evaluator.index');
    Route::match(['get', 'post'], '/', 'EvaluatorController@create')->name('evaluator.index');
    Route::get('/resend-invite/{code}', 'EvaluatorController@resendInvite')->name('evaluator.resend');
    Route::get('/delete-evaluator/{id}', 'EvaluatorController@delete')->name('evaluator.delete');
    Route::match(['get', 'post'], '/login', 'AuthenticationController@showEvaluatorLogin')->name('evaluator.login');
    Route::post('/evaluator-login', 'AuthenticationController@postEvaluatorlogin')->name('evaluator_login');
});

Route::group(['prefix' => 'evaluator-dashboard'], function () {
    Route::match(['get'], '/', 'EvaluatorController@dashboard')->name('evaluator.dashboard');
    Route::post('evaluatorComment', 'EvaluatorController@postComment')->name('evaluator.postcomment');
    Route::get('comments', 'EvaluatorController@comments')->name('evaluator.comments');
    Route::get('/contractors/{id}', 'ReportController@evaluatorContractorPreview')->name('evaluatorContractorPreview');
    Route::get('/contractors', 'EvaluatorController@evaluatorOpenBids')->name('evaluator.openbids');
    Route::get('/results', 'EvaluatorController@results')->name('evaluator.results');
    Route::get('/awards', 'EvaluatorController@evaluatorAwards')->name('evaluator.awards');
    Route::get('/results/{id}', 'EvaluatorController@showResult')->name('evaluator.show-result');
    Route::get('/results-contractor/{contractorId}', 'EvaluatorController@contractorResult')->name('evaluator.show-contractor-result');
    Route::get('logout', 'AuthenticationController@evaluatorLogout')->name('evaluatorLogout');
    Route::post('/evaluate-contractor', 'EvaluatorController@evaluateContractor')->name('evaluator.contractor');
});

//Route::delete('/qualifications/delete/{id}', 'QualificationController@delete')->name('qualifications.delete');

Route::post('/award', 'AwardController@createAward')->name('createAward');
Route::post('/award/approve-award/{id}', 'AwardController@approveAward')->name('approveAward');
Route::post('/award/upload-award-letter/{id}', 'AwardController@uploadAwardLetter')->name('uploadAwardLetter');
Route::post('/award/award-notification/{id}', 'AwardController@awardNotification')->name('awardNotification');
Route::post('/award/cancel-award/{id}', 'AwardController@cancellAward')->name('cancellAward');
Route::post('/award/accept-award/{id}', 'AwardController@acceptAward')->name('acceptAward');
Route::get('/award/downloadPDF/{id}','AwardController@downloadAwardPdf')->name('downloadAwardPdf');

