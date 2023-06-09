<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CartRepository;

class OrderController extends Controller
{
    public function __invoke()
    {
        $orders = auth()->user()->orders()->create([
            'order_number' => uniqid(),
        ]);

        (new CartRepository())->content()->each(function ($product) use ($orders) {
            
            $orders->products()->attach($product->id,[
                'total_price' =>$product->price * $product->quantity,
                'total_quantity' =>$product->quantity,
            ]);
        });
        (new CartRepository())->clear();

    }
}
