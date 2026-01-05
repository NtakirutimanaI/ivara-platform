<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PortfolioController extends Controller
{
    private $apiUrl = 'http://localhost:5001/api/portfolio';
    private $testimonialApiUrl = 'http://localhost:5001/api/testimonials';
    private $clientStatsApiUrl = 'http://localhost:5001/api/client-stats';

    public function index()
    {
        try {
            // Fetch portfolios
            $response = Http::get($this->apiUrl);
            $portfolios = $response->successful() ? $response->json() : [];

            // Fetch testimonials
            $testimonialResponse = Http::get($this->testimonialApiUrl);
            $testimonials = $testimonialResponse->successful() ? $testimonialResponse->json() : [];

            // Fetch client stats
            $statsResponse = Http::get($this->clientStatsApiUrl);
            $clientStats = $statsResponse->successful() ? $statsResponse->json() : [];

        } catch (\Exception $e) {
            $portfolios = [];
            $testimonials = [];
            $clientStats = [];
        }

        return view('web.portfolio.index', [
            'portfolios' => $portfolios,
            'testimonials' => $testimonials,
            'clientStats' => $clientStats,
        ]);
    }
}
