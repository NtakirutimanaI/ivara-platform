<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http as HttpFacade;
use App\Http\Controllers\Controller;

class GatewayController extends Controller
{
    /**
     * Base URL of the Node micro‑service.
     */
    private $nodeBase = 'http://localhost:5000/api';

    /**
     * Proxy any request to the Node service.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $resource   The collection name (e.g. clients, invoices)
     * @param  string|null $id    Optional MongoDB ObjectId
     * @return \Illuminate\Http\Response
     */
    public function proxy(Request $request, $resource, $id = null)
    {
        // Build target URL
        $url = $this->nodeBase . '/' . $resource;
        if ($id) {
            $url .= '/' . $id;
        }
        if ($request->query()) {
            $url .= '?' . http_build_query($request->query());
        }

        // Forward request with same method, headers and body
        $response = HttpFacade::withHeaders([
                // Pass through any auth token stored in Laravel session if needed
                // 'Authorization' => 'Bearer ' . $request->session()->get('jwt'),
                'Accept' => 'application/json',
            ])
            ->send($request->method(), $url, [
                'json' => $request->all(),
                'multipart' => $request->files->all(),
            ]);

        return response($response->body(), $response->status())
            ->withHeaders($response->headers());
    }
}
