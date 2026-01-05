

<?php


use App\Http\Controllers\Controller;
use App\Models\Product;

class ClientViewProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_published', true)->paginate(12);
        return view('client.products.index', compact('products'));
    }
}
