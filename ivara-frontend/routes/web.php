<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Gateway / Main Entry Routes
|--------------------------------------------------------------------------
*/

// --- Public Routes ---
Route::get('/', function () {
    try {
        $response = Illuminate\Support\Facades\Http::get('http://localhost:5001/api/pricing');
        $pricingParams = $response->successful() ? $response->json() : [];
    } catch (\Exception $e) {
        $pricingParams = [];
    }
    return view('web.index', ['pricingPlans' => $pricingParams]);
})->name('home');

Route::get('/index', function () {
    return redirect()->route('home');
})->name('index');
Route::get('/aboutus', function () { return view('web.aboutus'); })->name('aboutus');
Route::get('/team', function () { return view('web.team'); })->name('team');
Route::get('/support', function () { return view('web.support'); })->name('support');
Route::get('/quick-access', function () { return view('web.quick_access'); })->name('quick.access');
Route::view('/privacy-policy', 'web.privacy_policy')->name('web.privacy-policy');
Route::view('/terms', 'web.terms')->name('web.terms');
Route::view('/sitemap', 'web.sitemap')->name('web.sitemap');

// --- Resources & Knowledge Base ---
Route::get('/resources/{type}', [App\Http\Controllers\Web\ResourceController::class, 'index'])
    ->where('type', 'blog|how-to-start|user-guide|documentation|updates|video-tutorials|faqs')
    ->name('resource.index');

// Alias for resources
Route::get('/resources', function() { 
    return redirect()->route('resource.index', 'blog'); 
})->name('resources.index');

Route::get('/faq', function() { 
    return redirect()->route('resource.index', 'faqs'); 
})->name('faq.index');

Route::get('/resources/item/{slug}', [App\Http\Controllers\Web\ResourceController::class, 'show'])->name('resource.show');

// Redirect old updates route
Route::get('/updates', function() { return redirect()->route('resource.index', 'updates'); })->name('web.updates');

// Contact Form Routes
Route::get('/contact', function() { return view('web.contact'); })->name('contact.index');
Route::post('/contact/send', function() { return redirect()->route('contact.index'); })->name('contact.send');

// Newsletter Subscription Route
Route::post('/newsletter/subscribe', function() { return back(); })->name('newsletter.subscribe');

// Solutions Routes
Route::get('/solutions/fashion', function () { return view('web.solutions.fashion'); })->name('solutions.fashion');
Route::get('/solutions/technical', function () { return view('web.solutions.technical'); })->name('solutions.technical');
Route::get('/solutions/transport', function () { return view('web.solutions.transport'); })->name('solutions.transport');
Route::get('/solutions/agriculture', function () { return view('web.solutions.agriculture'); })->name('solutions.agriculture');
Route::get('/solutions/creative', function () { return view('web.solutions.creative'); })->name('solutions.creative');
Route::get('/solutions/education', function () { return view('web.solutions.education'); })->name('solutions.education');
Route::get('/solutions/media', function () { return view('web.solutions.media'); })->name('solutions.media');
Route::get('/solutions/legal', function () { return view('web.solutions.legal'); })->name('solutions.legal');
Route::get('/solutions/other', function () { return view('web.solutions.other'); })->name('solutions.other');

Route::get('/portfolio', [App\Http\Controllers\Web\PortfolioController::class, 'index'])->name('portfolio.index');

// Portfolio Section Routes (redirect to main portfolio with anchors)
Route::get('/portfolio/clients', function () {
    return redirect('/portfolio#clients');
})->name('portifolio.clients');

Route::get('/portfolio/success-stories', function () {
    return redirect('/portfolio#success-stories');
})->name('portifolio.success-stories');

Route::get('/portfolio/testimonials', function () {
    return redirect('/portfolio#testimonials');
})->name('portifolio.testimonial-reviews');

// Marketplace Routes
Route::get('/marketplace', [App\Http\Controllers\Web\MarketplaceController::class, 'index'])->name('marketplace.index');
Route::get('/market/{category}', [App\Http\Controllers\Web\MarketplaceController::class, 'index'])->name('market.category');
Route::get('/product/{id}', [App\Http\Controllers\Web\MarketplaceController::class, 'show'])->name('product.show');
Route::get('/cart', [App\Http\Controllers\Web\CartController::class, 'index'])->name('cart.index');
Route::get('/checkout', [App\Http\Controllers\Web\CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/checkout/place-order', [App\Http\Controllers\Web\CartController::class, 'placeOrder'])->name('cart.placeOrder');
Route::get('/orders', [App\Http\Controllers\Web\UserOrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [App\Http\Controllers\Web\UserOrderController::class, 'show'])->name('orders.show');

// Seller Dashboard Routes
Route::get('/seller/dashboard', [App\Http\Controllers\Web\SellerController::class, 'dashboard'])->name('seller.dashboard');
Route::get('/seller/products/create', [App\Http\Controllers\Web\SellerController::class, 'create'])->name('seller.products.create');
Route::post('/seller/products', [App\Http\Controllers\Web\SellerController::class, 'store'])->name('seller.products.store');
Route::get('/seller/products/{id}/edit', [App\Http\Controllers\Web\SellerController::class, 'edit'])->name('seller.products.edit');
Route::put('/seller/products/{id}', [App\Http\Controllers\Web\SellerController::class, 'update'])->name('seller.products.update');
Route::delete('/seller/products/{id}', [App\Http\Controllers\Web\SellerController::class, 'destroy'])->name('seller.products.delete');
Route::patch('/seller/orders/{id}/status', [App\Http\Controllers\Web\SellerController::class, 'updateOrderStatus'])->name('seller.orders.status');

// B2B Wholesale Marketplace Routes
Route::get('/b2b', function () { return view('web.b2b.index'); })->name('b2b.index');
Route::post('/b2b/register-interest', [App\Http\Controllers\Web\B2BController::class, 'registerInterest'])->name('b2b.register.interest');

// Bookings Routes
Route::get('/bookings', function () { return view('web.bookings', ['services' => []]); })->name('bookings.index');

// --- Authentication (Core Service) ---
require __DIR__.'/auth.php';

// --- Core Modules ---
require __DIR__.'/modules/admin.php';
require __DIR__.'/modules/super_admin.php';
require __DIR__.'/modules/manager.php';
require __DIR__.'/modules/supervisor.php';
require __DIR__.'/modules/user.php';
require __DIR__.'/modules/notification.php';

// --- Domain Modules (The 7 Categories) ---
require __DIR__.'/categories/technical-repair.php';
require __DIR__.'/modules/creative_lifestyle.php';
require __DIR__.'/modules/transport_travel.php';
require __DIR__.'/modules/food_events_fashion.php';
require __DIR__.'/modules/food_fashion.php';
require __DIR__.'/modules/education_knowledge.php';
require __DIR__.'/modules/agriculture_environment.php';
require __DIR__.'/modules/media_entertainment.php';
require __DIR__.'/modules/legal_professional.php';
require __DIR__.'/modules/other_services.php';

// --- Language Switching Routes ---
Route::post('/language/switch', [App\Http\Controllers\LanguageController::class, 'switch'])->name('language.switch');
Route::get('/language/current', [App\Http\Controllers\LanguageController::class, 'current'])->name('language.current');


// --- Catch-all / Gateway Fallback ---
Route::fallback(function () {
    return redirect()->route('home');
});
