<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('NODE_API_URL') . '/api/cart';
    }

    public function index()
    {
        try {
            $response = Http::timeout(5)->get($this->apiUrl);

            if ($response->successful()) {
                $cartItems = $response->json()['data'] ?? [];
            } else {
                $cartItems = [];
            }

        } catch (\Exception $e) {
            $cartItems = [];
        }

       return view('cart', compact('cartItems'));
    }
}
