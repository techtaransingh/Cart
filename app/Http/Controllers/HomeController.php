<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;

class HomeController extends Controller
{
    public function homeIndex()
    {
        $loggedIn = Auth::user();

        $products = Product::all();
        $categories = Category::all();
        $cart_product_id = [];
        $cart = Cart::all();
        $cartCount = 0;
        $total = 0;
        foreach ($cart as $val) {
            $cart_product_id[] = $val->product_id;
            $cartCount = $val->quantity + $cartCount;
            $total = $total + $val->price;
        }
        // $cartCount = $cart->count();
        // print_r($cart_product_id);
        // die;
        return view('home.home', [
            'products' => $products,
            'categories' => $categories,
            'cartCount' => $cartCount,
            'loggedIn' => $loggedIn,
            'cart_product_id' => $cart_product_id,
            'total' => $total
        ]);

    }
    public function shoppingCart(Request $request, $id)
    {

        $productIdSaved = new Cart;
        // print_r($productIdSaved);
        $productIdSaved->product_id = $id;
        $productIdSaved->quantity = 1;
        $product = Product::find($id);
        $productIdSaved->product_name = $product->name;
        $productIdSaved->price = $product->price;
        $productIdSaved->image = $product->image;

        $productIdSaved->save();

        return back();

    }
    public function viewCart()
    {
        $loggedIn = Auth::user();

        $cartData = Cart::all();
        $cartCount = 0;
        $total = 0;
        foreach ($cartData as $val) {
            $cart_product_id[] = $val->product_id;
            $cartCount = $val->quantity + $cartCount;
            $total = $total + $val->price;
        }
        // die;
        if ($cartCount == 0) {
            $cartMessage = 'Cart is empty.';
            return view('home.shoppingCart', [
                'cartMessage' => $cartMessage,
                'cartCount' => $cartCount,
                'cartData' => $cartData,
                'total' => $total
            ]);

        } else {
            return view('home.shoppingCart', [
                'cartCount' => $cartCount,
                'loggedIn' => $loggedIn,
                'cartData' => $cartData,
                'total' => $total
            ]);
        }
    }
    public function updateCart(Request $request)
    {

        for ($i = 0; $i < count($request->quantity); $i++) {
            $quantityUpdated = $request->quantity[$i];
            $product_id = $request->product_id[$i];
            $productQuantity[$product_id] = $quantityUpdated; //productID => quantity(associative array bnata)
        }

        foreach ($productQuantity as $key => $value) {
            $product = Product::where('id', $key)->first();

            $cartQuantityUpdated = Cart::where('product_id', $key)->first();
            if ($value == 0) {
                $cartQuantityUpdated->delete();
            } else {
                $cartQuantityUpdated->quantity = $value;
                $cartQuantityUpdated->price = $product->price * $value;
                // print_r($cartQuantityUpdated->price);

                $cartQuantityUpdated->save();
            }
        }
        // die;
        return back();
    }
    public function checkout(Request $request)
    {
        Cart::truncate();
        return redirect('/')->with('message', 'Order placed successfully.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('message', 'Logged out successfully.');
    }
}