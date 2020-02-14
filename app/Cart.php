<?php

namespace App;

use Illuminate\Support\Arr;

class Cart
{
  public $meals = [];
  public $totalQty = 0;
  public $totalPrice = 0;

  public function __construct($cart = null)
  {
    if($cart)
    {
      $this->meals = $cart->items;
      $this->totalQty = $cart->totalQty;
      $this->totalPrice = $cart->totalPrice;
    } else {
      $this->meals = [];
      $this->totalQty = 0;
      $this->totalPrice = 0;
    }
  }

  public function add($product, $quantity)
  {
    $meal = [
      'name' => $product->name,
      'price' => $product->price,
      'qty' => 1,
      'img' => $product->image_url
    ];
    if(! array_key_exists($product->id, $this->meals) )
    {
      $this->meals[$product->id] = $meal;
    }
    // $meal['qty']++ ;
    // $meal['price'] = $product->price * $meal['qty'];
    // $this->items[$product->id] = $meal;
    // $this->totalQty++;
    // $this->totalPrice += $product->price;
    $this->meals[$product->id]['qty'] = $quantity;
    $this->totalQty = $quantity;
    $this->totalPrice = $product->price * $quantity;
  }

}
