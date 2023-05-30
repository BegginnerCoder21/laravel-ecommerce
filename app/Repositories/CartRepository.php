<?php
namespace App\Repositories;

use App\Models\Product;

class CartRepository
{
    public function add(Product $product)
    {
        
        session(auth()->user()->id)->add(array(

            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associateModel' => $product
        ));

        return $this->count();
    }

    public function content()
    {
        return session(auth()->user()->id)->getContent();
    }

    public function count()
    {
        return $this->content()->sum('quantity');
    }
}
