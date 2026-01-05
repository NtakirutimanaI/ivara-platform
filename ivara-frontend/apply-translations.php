#!/usr/bin/env php
<?php
/**
 * Script to replace hardcoded text with translation functions in header.blade.php
 * This will make the language selector actually work by using translation files
 */

$headerFile = __DIR__ . '/resources/views/layouts/header.blade.php';

if (!file_exists($headerFile)) {
    die("Header file not found!\n");
}

$content = file_get_contents($headerFile);

// Define replacements (hardcoded text => translation key)
$replacements = [
    // Navigation
    '>Solutions<' => '>{{ __("messages.solutions") }}<',
    '>Why Ivara<' => '>{{ __("messages.why_ivara") }}<',
    '>Services<' => '>{{ __("messages.services") }}<',
    '>Marketplace<' => '>{{ __("messages.marketplace") }}<',
    '>Pricing<' => '>{{ __("messages.pricing") }}<',
    '>Portfolio<' => '>{{ __("messages.portfolio") }}<',
    '>Resources<' => '>{{ __("messages.resources") }}<',
    '>Support<' => '>{{ __("messages.support") }}<',
    '>Dashboard<' => '>{{ __("messages.dashboard") }}<',
    
    // Actions
    '>View All<' => '>{{ __("messages.view_all") }}<',
    '>Learn More<' => '>{{ __("messages.learn_more") }}<',
    '>Book A Free Demo<' => '>{{ __("messages.book_demo") }}<',
    '>Back to Home<' => '>{{ __("messages.back_to_home") }}<',
    
    // Marketplace
    '>Public Market<' => '>{{ __("messages.public_market") }}<',
    '>B2B Wholesale<' => '>{{ __("messages.b2b_wholesale") }}<',
    '>Explore IVARA Marketplaces<' => '>{{ __("messages.explore_marketplaces") }}<',
    '>All Categories<' => '>{{ __("messages.all_categories") }}<',
    '>View All 9 Categories<' => '>{{ __("messages.view_all_categories") }}<',
    
    // Categories
    '>Technical<' => '>{{ __("messages.technical_repair") }}<',
    '>Food & Fashion<' => '>{{ __("messages.food_fashion") }}<',
    '>Transport<' => '>{{ __("messages.transport_travel") }}<',
    '>Education<' => '>{{ __("messages.education_knowledge") }}<',
    '>Technical & Repair<' => '>{{ __("messages.technical_repair") }}<',
    '>Transport & Travel<' => '>{{ __("messages.transport_travel") }}<',
    '>Knowledge<' => '>{{ __("messages.education_knowledge") }}<',
    '>Agriculture<' => '>{{ __("messages.agriculture_environment") }}<',
    '>Creative<' => '>{{ __("messages.creative_lifestyle") }}<',
    '>Media<' => '>{{ __("messages.media_entertainment") }}<',
    '>Legal<' => '>{{ __("messages.legal_professional") }}<',
    '>Other<' => '>{{ __("messages.other_services") }}<',
    
    // User actions (Dashboard header)
    '>My Orders<' => '>{{ __("messages.my_orders") }}<',
    '>My Cart<' => '>{{ __("messages.my_cart") }}<',
    '>Notifications<' => '>{{ __("messages.notifications") }}<',
    '>Messages<' => '>{{ __("messages.messages") }}<',
    '>My Profile<' => '>{{ __("messages.my_profile") }}<',
    '>Settings<' => '>{{ __("messages.settings") }}<',
    '>Sign Out<' => '>{{ __("messages.sign_out") }}<',
    
    // Quick Actions
    '>Quick Actions<' => '>{{ __("messages.quick_actions") }}<',
    '>New Product<' => '>{{ __("messages.new_product") }}<',
    '>New Client<' => '>{{ __("messages.new_client") }}<',
    '>New Repair<' => '>{{ __("messages.new_repair") }}<',
    
    // Notifications
    '>Go to Notifications Center<' => '>{{ __("messages.notifications_center") }}<',
    '>View All Messages<' => '>{{ __("messages.view_all_messages") }}<',
];

// Apply replacements
foreach ($replacements as $search => $replace) {
    $content = str_replace($search, $replace, $content);
}

// Write back to file
file_put_contents($headerFile, $content);

echo "✅ Header file updated successfully!\n";
echo "✅ " . count($replacements) . " translations applied.\n";
echo "\nNow clear the view cache:\n";
echo "php artisan view:clear\n";
?>
