<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;

class HomeController extends Controller
{
    public function homeIndex()
    {
        $products = Product::all();
        $categories = Category::all();
        $cart = new Cart;
        $cartCount = $cart->count();

        return view('home.home', [
            'products' => $products,
            'categories' => $categories,
            'cartCount' => $cartCount
        ]);

    }
    public function shoppingCart(Request $request, $id)
    {

        $productIdSaved = new Cart;
        $productIdSaved->product_id = $id;
        // $productIdSaved->name = 'Default Name';
        $productIdSaved->save();
        // print_r($productIdSaved);
        // die;
        return back();

    }
    public function viewCart()
    {
        $cart = new Cart;
        $cartCount = $cart->count();
        // echo 'cjnkfdk';
        return view('home.shoppingCart', ['cartCount' => $cartCount]);
    }
}