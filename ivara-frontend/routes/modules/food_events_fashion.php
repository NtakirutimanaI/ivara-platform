<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Food, Events & Fashion Routes
|--------------------------------------------------------------------------
*/

// --- Management (Shared - Dashed Names) ---
Route::middleware(['auth', 'ivara_role:admin', 'category_access:food-events-fashion'])
    ->prefix('admin/food-events-fashion')->name('admin.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.admin.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:manager', 'category_access:food-events-fashion'])
    ->prefix('manager/food-events-fashion')->name('manager.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.manager.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:supervisor', 'category_access:food-events-fashion'])
    ->prefix('supervisor/food-events-fashion')->name('supervisor.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.supervisor.index'); })->name('index');
});

// --- Event Planning & Management (Unique - Dashed Names) ---
Route::middleware(['auth', 'ivara_role:wedding_planner', 'category_access:food-events-fashion'])
    ->prefix('wedding-planner/dashboard')->name('wedding_planner.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.event-planning-management.wedding-planner.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:corporate_event_organizer', 'category_access:food-events-fashion'])
    ->prefix('corporate-organizer/dashboard')->name('corporate_event.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.event-planning-management.corporate-event-organizer.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:birthday_party_organizer', 'category_access:food-events-fashion'])
    ->prefix('birthday-organizer/dashboard')->name('birthday_organizer.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.event-planning-management.birthday-party-organizer.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:conference_seminar_organizer', 'category_access:food-events-fashion'])
    ->prefix('conference-organizer/dashboard')->name('conference_organizer.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.event-planning-management.conference-seminar-organizer.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:exhibition_trade_fair_organizer', 'category_access:food-events-fashion'])
    ->prefix('trade-fair-organizer/dashboard')->name('exhibition_organizer.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.event-planning-management.exhibition-trade-fair-organizer.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:concert_festival_organizer', 'category_access:food-events-fashion'])
    ->prefix('festival-organizer/dashboard')->name('concert_festival_organizer.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.event-planning-management.concert-festival-organizer.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:event_coordinator', 'category_access:food-events-fashion'])
    ->prefix('coordinator/dashboard')->name('event_coordinator.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.event-planning-management.event-coordinator.index'); })->name('index');
});

// --- Party & Event Services (Unique - Dashed Names) ---
Route::middleware(['auth', 'ivara_role:photographer_videographer', 'category_access:food-events-fashion'])
    ->prefix('photographer/dashboard')->name('photographer.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.party-event-services.photographer-videographer.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:music_dj_services', 'category_access:food-events-fashion'])
    ->prefix('dj/dashboard')->name('music_dj.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.party-event-services.music-dj-services.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:lighting_sound_technician', 'category_access:food-events-fashion'])
    ->prefix('technician/dashboard')->name('lighting_sound.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.party-event-services.lighting-sound-technician.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:decorator_event_stylist', 'category_access:food-events-fashion'])
    ->prefix('decorator/dashboard')->name('decorator.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.party-event-services.decorator-event-stylist.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:mc_host_entertainer', 'category_access:food-events-fashion'])
    ->prefix('host/dashboard')->name('mc_host.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.party-event-services.mc-host-entertainer.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:stage_av_setup', 'category_access:food-events-fashion'])
    ->prefix('stage-setup/dashboard')->name('stage_av.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.party-event-services.stage-av-setup.index'); })->name('index');
});

// --- Food Services (Unique - Dashed Names) ---
Route::middleware(['auth', 'ivara_role:catering_services', 'category_access:food-events-fashion'])
    ->prefix('catering/dashboard')->name('catering.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.food-services.catering-services.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:bakery_cake_services', 'category_access:food-events-fashion'])
    ->prefix('bakery/dashboard')->name('bakery.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.food-services.bakery-cake-services.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:beverage_services', 'category_access:food-events-fashion'])
    ->prefix('beverage/dashboard')->name('beverage.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.food-services.beverage-services.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:other_food_services', 'category_access:food-events-fashion'])
    ->prefix('other-food/dashboard')->name('other_food.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.food-services.other-food-services.index'); })->name('index');
});

// --- Fashion (Unique - Dashed Names) ---
Route::middleware(['auth', 'ivara_role:event_tailoring', 'category_access:food-events-fashion'])
    ->prefix('tailor/dashboard')->name('event_tailoring.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.fashion-event-clothing.event-tailoring.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:event_clothes_rental', 'category_access:food-events-fashion'])
    ->prefix('rental/dashboard')->name('clothes_rental.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.service-provider.fashion-event-clothing.event-clothes-rental.index'); })->name('index');
});

// --- Support (Unique - Dashed Names) ---
Route::middleware(['auth', 'ivara_role:post_event_cleanup_feedback', 'category_access:food-events-fashion'])
    ->prefix('cleanup/dashboard')->name('cleanup.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.support-provider.post-event-cleanup-feedback.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:sound_equipment_maintenance', 'category_access:food-events-fashion'])
    ->prefix('sound-maintenance/dashboard')->name('equipment_maintenance.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.support-provider.equipment-maintenance.sound-maintenance.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:menu_tasting_reviews', 'category_access:food-events-fashion'])
    ->prefix('menu-reviews/dashboard')->name('catering_followup.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.support-provider.catering-followup.menu-reviews.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:customer_loyalty_repeated_events', 'category_access:food-events-fashion'])
    ->prefix('loyalty/dashboard')->name('customer_loyalty.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.support-provider.customer-loyalty-repeated-events.index'); })->name('index');
});

// --- Business (Unique - Dashed Names) ---
Route::middleware(['auth', 'ivara_role:event_planning_agency', 'category_access:food-events-fashion'])
    ->prefix('event-agency/dashboard')->name('fef_business.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.businessperson.event-planning-agency.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:rental_business', 'category_access:food-events-fashion'])
    ->prefix('rental-business/dashboard')->name('rental_business.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.businessperson.rental-business.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:catering_business', 'category_access:food-events-fashion'])
    ->prefix('catering-business/dashboard')->name('catering_business.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.businessperson.catering-business.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:venue_owner', 'category_access:food-events-fashion'])
    ->prefix('venue-owner/dashboard')->name('venue_owner.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.businessperson.venue-owner.index'); })->name('index');
});

// --- Special (Shared - Dashed Names with prefix) ---
Route::middleware(['auth', 'ivara_role:mediator', 'category_access:food-events-fashion'])
    ->prefix('mediator/food-events-fashion')->name('fef_mediator.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.mediator.index'); })->name('index');
});

Route::middleware(['auth', 'ivara_role:moderator', 'category_access:food-events-fashion'])
    ->prefix('moderator/food-events-fashion')->name('fef_moderator.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.moderator.index'); })->name('index');
});

// --- Client (Shared - Dashed Names with prefix) ---
Route::middleware(['auth', 'ivara_role:fef_client', 'category_access:food-events-fashion'])
    ->prefix('client/food-events-fashion')->name('fef_client.food-events-fashion.')->group(function () {
    Route::get('/', function () { return view('categories.food-events-fashion.client.index'); })->name('index');
});
