<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ResourceController extends Controller
{
    private $apiUrl = 'http://localhost:5001/api/resources';

    public function index($type)
    {
        // 1. Map URL types to View Names
        // URL: /resources/blog -> View: web.resources.blog
        $validTypes = ['blog', 'how-to-start', 'user-guide', 'documentation', 'updates', 'video-tutorials', 'faqs'];
        
        if (!in_array($type, $validTypes)) {
            abort(404);
        }
        
        // 2. Map URL param to Backend DB Type
        $dbType = $type;
        if($type == 'how-to-start') $dbType = 'guide'; 
        if($type == 'video-tutorials') $dbType = 'tutorial';
        if($type == 'updates') $dbType = 'update';

        // 3. Fetch Data
        try {
            if ($type === 'faqs') {
                $response = Http::get("{$this->apiUrl}/faqs");
            } else {
                $response = Http::get("{$this->apiUrl}/{$dbType}");
            }
            
            $data = $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            $data = [];
        }

        // 4. Return specific view
        $viewName = str_replace('-', '_', $type);
        return view("web.resources.{$viewName}", ['items' => $data, 'title' => ucfirst(str_replace('-', ' ', $type))]);
    }

    public function show($slug)
    {
        try {
            $response = Http::get("{$this->apiUrl}/item/{$slug}");
            if ($response->successful()) {
                return view('web.resources.single', ['item' => $response->json()]);
            }
        } catch (\Exception $e) {}
        
        abort(404);
    }
}
