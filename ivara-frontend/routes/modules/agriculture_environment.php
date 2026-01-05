<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Agriculture, Farming & Environment Routes
|--------------------------------------------------------------------------
*/

// --- Management (Shared - Dashed Names) ---
Route::middleware(['auth', 'ivara_role:admin', 'category_access:agriculture-farming-environment'])
    ->prefix('admin/agriculture-environment')->name('admin.agriculture-farming-environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.admin.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:manager', 'category_access:agriculture-farming-environment'])
    ->prefix('manager/agriculture-environment')->name('manager.agriculture-farming-environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.manager.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:supervisor', 'category_access:agriculture-farming-environment'])
    ->prefix('supervisor/agriculture-environment')->name('supervisor.agriculture-farming-environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.supervisor.index'); })->name('index');
});

// --- Specific Roles (Unique - Underscore Names with Controller Shortcuts) ---
// Crop
Route::middleware(['auth', 'ivara_role:crop_farming_followups', 'category_access:agriculture-farming-environment'])
    ->prefix('crop-followup/dashboard')->name('crop_followup.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.crop-farming.crop-farming-followups.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:soil_management', 'category_access:agriculture-farming-environment'])
    ->prefix('soil-mgmt/dashboard')->name('soil_mgmt.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.crop-farming.soil-management.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:irrigation_support', 'category_access:agriculture-farming-environment'])
    ->prefix('irrigation/dashboard')->name('irrigation.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.crop-farming.irrigation-support.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:pest_disease_management', 'category_access:agriculture-farming-environment'])
    ->prefix('pest-mgmt/dashboard')->name('pest_mgmt.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.crop-farming.pest-disease-management.index'); })->name('index');
});

// Livestock
Route::middleware(['auth', 'ivara_role:animal_health_veterinary', 'category_access:agriculture-farming-environment'])
    ->prefix('veterinary/dashboard')->name('veterinary.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.livestock-farming.animal-health-veterinary.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:breeding_reproduction', 'category_access:agriculture-farming-environment'])
    ->prefix('breeder/dashboard')->name('breeder.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.livestock-farming.breeding-reproduction.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:feed_nutrition_management', 'category_access:agriculture-farming-environment'])
    ->prefix('nutritionist/dashboard')->name('nutritionist.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.livestock-farming.feed-nutrition-management.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:livestock_monitoring', 'category_access:agriculture-farming-environment'])
    ->prefix('livestock-monitor/dashboard')->name('livestock_monitor.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.livestock-farming.livestock-monitoring.index'); })->name('index');
});

// Aquaculture
Route::middleware(['auth', 'ivara_role:fish_farming_services', 'category_access:agriculture-farming-environment'])
    ->prefix('fish-farm/dashboard')->name('fish_farm.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.aquaculture.fish-farming-services.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:water_quality_management', 'category_access:agriculture-farming-environment'])
    ->prefix('water-quality/dashboard')->name('water_quality.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.aquaculture.water-quality-management.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:harvest_processing', 'category_access:agriculture-farming-environment'])
    ->prefix('harvest-proc/dashboard')->name('harvest_proc.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.aquaculture.harvest-processing.index'); })->name('index');
});

// Apiculture
Route::middleware(['auth', 'ivara_role:bee_farming_services', 'category_access:agriculture-farming-environment'])
    ->prefix('bee-farm/dashboard')->name('bee_farm.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.apiculture.bee-farming-services.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:hive_management', 'category_access:agriculture-farming-environment'])
    ->prefix('hive-mgmt/dashboard')->name('hive_mgmt.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.apiculture.hive-management.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:honey_production', 'category_access:agriculture-farming-environment'])
    ->prefix('honey-prod/dashboard')->name('honey_prod.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.apiculture.honey-production.index'); })->name('index');
});

// Environment
Route::middleware(['auth', 'ivara_role:sustainable_farming', 'category_access:agriculture-farming-environment'])
    ->prefix('sustainable/dashboard')->name('sustainable.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.environmental-management.sustainable-farming.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:climate_smart_agriculture', 'category_access:agriculture-farming-environment'])
    ->prefix('climate-smart/dashboard')->name('climate_smart.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.environmental-management.climate-smart-agriculture.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:conservation_practices', 'category_access:agriculture-farming-environment'])
    ->prefix('conservation/dashboard')->name('conservation.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.service-provider.environmental-management.conservation-practices.index'); })->name('index');
});

// Support - Extension
Route::middleware(['auth', 'ivara_role:farmer_training', 'category_access:agriculture-farming-environment'])
    ->prefix('farmer-train/dashboard')->name('farmer_train.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.support-provider.agriculture-extension.farmer-training.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:advisory_consultation', 'category_access:agriculture-farming-environment'])
    ->prefix('agri-advisor/dashboard')->name('agri_advisor.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.support-provider.agriculture-extension.advisory-consultation.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:field_demonstration', 'category_access:agriculture-farming-environment'])
    ->prefix('field-demo/dashboard')->name('field_demo.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.support-provider.agriculture-extension.field-demonstration.index'); })->name('index');
});

// Support - Input
Route::middleware(['auth', 'ivara_role:seeds_fertilizers', 'category_access:agriculture-farming-environment'])
    ->prefix('seeds-fert/dashboard')->name('seeds_fert.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.support-provider.input-supply-support.seeds-fertilizers.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:animal_feed', 'category_access:agriculture-farming-environment'])
    ->prefix('animal-feed/dashboard')->name('animal_feed.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.support-provider.input-supply-support.animal-feed.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:equipment_tools', 'category_access:agriculture-farming-environment'])
    ->prefix('agri-tools/dashboard')->name('agri_tools.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.support-provider.input-supply-support.equipment-tools.index'); })->name('index');
});

// Support - M&E
Route::middleware(['auth', 'ivara_role:farm_inspection', 'category_access:agriculture-farming-environment'])
    ->prefix('farm-inspect/dashboard')->name('farm_inspect.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.support-provider.monitoring-evaluation.farm-inspection.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:data_reporting', 'category_access:agriculture-farming-environment'])
    ->prefix('data-report/dashboard')->name('data_report.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.support-provider.monitoring-evaluation.data-reporting.index'); })->name('index');
});

// Support - Post Harvest
Route::middleware(['auth', 'ivara_role:storage_preservation', 'category_access:agriculture-farming-environment'])
    ->prefix('storage/dashboard')->name('storage.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.support-provider.post-harvest-support.storage-preservation.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:market_linkage', 'category_access:agriculture-farming-environment'])
    ->prefix('market-link/dashboard')->name('market_link.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.support-provider.post-harvest-support.market-linkage.index'); })->name('index');
});

// Business
Route::middleware(['auth', 'ivara_role:agribusiness_owner', 'category_access:agriculture-farming-environment'])
    ->prefix('agri-biz/dashboard')->name('agri_biz.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.businessperson.agribusiness-owner.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:farm_owner', 'category_access:agriculture-farming-environment'])
    ->prefix('farm-owner/dashboard')->name('farm_owner.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.businessperson.farm-owner.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:cooperative_organization', 'category_access:agriculture-farming-environment'])
    ->prefix('coop/dashboard')->name('coop.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.businessperson.cooperative-organization.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:input_supply_business', 'category_access:agriculture-farming-environment'])
    ->prefix('input-biz/dashboard')->name('input_biz.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.businessperson.input-supply-business.index'); })->name('index');
});

// Shared Support Roles (Underscore Names)
Route::middleware(['auth', 'ivara_role:mediator', 'category_access:agriculture-farming-environment'])
    ->prefix('mediator/agriculture-environment')->name('mediator.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.mediator.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:moderator', 'category_access:agriculture-farming-environment'])
    ->prefix('moderator/agriculture-environment')->name('moderator.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.moderator.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:client', 'category_access:agriculture-farming-environment'])
    ->prefix('client/agriculture-environment')->name('client.agriculture_environment.')->group(function () {
    Route::get('/', function () { return view('categories.agriculture-farming-environment.client.index'); })->name('index');
});
