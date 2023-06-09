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

    public function increase($id){
        \Cart::session(auth()->user()->id)->update($id,[
            'quantity' => +1
        ]);

    }

    public function decrease($id){

        $items = \Cart::session(auth()->user()->id)->get($id);

        if($items->quantity == 1){

            $this->remove($id);
            return;
        }

        \Cart::session(auth()->user()->id)->update($id,[
            'quantity' => -1
        ]);
    }

    public function total()
    {
        return \Cart::session(auth()->user()->id)->getTotal();
    }

    public function remove($id){

        \Cart::session(auth()->user()->id)->remove($id);
    }

}
