<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class HeaderComposer
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(env('BACKEND_API_URL', 'http://localhost:5001'), '/');
        if (str_ends_with($this->baseUrl, '/api')) {
            $this->baseUrl = substr($this->baseUrl, 0, -4);
        }
    }

    public function compose(View $view)
    {
        // Fetch Portfolios for the Mega Menu
        $portfolioMenu = cache()->remember('header_portfolios', 60, function () {
            try {
                $response = Http::timeout(2)->get($this->baseUrl . '/api/portfolio');
                if ($response->successful()) {
                    return $response->json(); // Returns array
                }
            } catch (\Exception $e) {
                Log::warning('HeaderComposer: Failed to fetch portfolios: ' . $e->getMessage());
            }
            return [];
        });

        // Fetch Featured Resources
        $latestResources = cache()->remember('header_resources', 60, function () {
            try {
                $response = Http::timeout(2)->get($this->baseUrl . '/api/resources/featured');
                if ($response->successful()) {
                    return array_slice($response->json(), 0, 3); // Take top 3
                }
            } catch (\Exception $e) {
                Log::warning('HeaderComposer: Failed to fetch resources: ' . $e->getMessage());
            }
            // Fallback content if API fails or is empty
            return [
                [
                    'title' => 'B2B vs B2C Marketplaces',
                    'slug' => 'b2b-vs-b2c-marketplaces',
                    'type' => 'Blog',
                    'image' => 'https://placehold.co/100x70/0A1128/FFF?text=Blog'
                ],
                [
                    'title' => 'Create an Online Marketplace',
                    'slug' => 'create-online-marketplace-guide',
                    'type' => 'Guide',
                    'image' => 'https://placehold.co/100x70/ffb700/000?text=Guide'
                ],
                 [
                    'title' => 'Get Started with IVARA',
                    'slug' => 'get-started-with-ivara',
                    'type' => 'Tutorial',
                    'image' => 'https://placehold.co/100x70/162447/FFF?text=Tutorial'
                ]
            ];
        });

        $view->with('portfolioMenu', $portfolioMenu);
        $view->with('latestResources', $latestResources);
    }
}
