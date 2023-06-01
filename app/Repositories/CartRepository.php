<?php

namespace App\Repositories;

use App\Models\Product;

class CartRepository
{
    public function add(Product $product): int
    {

        \Cart::session(auth()->user()->id)->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' =>$product->image,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));

        return $this->count();
    }

    public function content()
    {
        return \Cart::session(auth()->user()->id)->getContent();
    }

    public function count()
    {
        return $this->content()->sum('quantity');
    }
}
