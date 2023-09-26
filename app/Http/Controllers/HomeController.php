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
        $products = Product::paginate(4);
        $categories = Category::all();

        $cart = Cart::where('user_id', NULL)->get();
        $cartCount = 0;
        $total = 0;
        if (!empty(Auth::user())) {
            $cart_product_id = [];
            $loggedIn = Auth::user();

            $loggedInId = Auth::user()->id;
            $cartData = Cart::where('user_id', $loggedInId)->get();
            foreach ($cartData as $val) {
                $cart_product_id[] = $val->product_id;
                $cartCount = $val->quantity + $cartCount;
                $total = $total + $val->price;
            }

        } else {
            $cartData = Cart::where('user_id', NULL)->get();
            $loggedIn = null;
            $cart_product_id = [];
            foreach ($cartData as $val) {
                $cart_product_id[] = $val->product_id;
                $cartCount = $val->quantity + $cartCount;
                $total = $total + $val->price;
            }
        }

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
        $productIdSaved->product_id = $id;
        $productIdSaved->quantity = 1;
        $product = Product::find($id);
        $productIdSaved->product_name = $product->name;
        $productIdSaved->price = $product->price;
        $productIdSaved->image = $product->image;

        if (!empty(Auth::user())) {
            $productIdSaved->user_id = Auth::user()->id;
            $productIdSaved->name = Auth::user()->name;
            $productIdSaved->email = Auth::user()->email;

        }

        $productIdSaved->save();

        return back();

    }
    public function viewCart()
    {
        $cartCount = 0;
        $total = 0;

        if (!empty(Auth::user())) {
            $loggedIn = Auth::user();

            $cartData = Cart::where('user_id', $loggedIn->id)->get();
            $cart_product_id = [];
            foreach ($cartData as $val) {
                $cart_product_id[] = $val->product_id;
                $cartCount = $val->quantity + $cartCount;
                $total = $total + $val->price;
            }
        } else {
            $cartData = Cart::where('user_id', NULL)->get();
            $loggedIn = null;
            $cart_product_id = [];
            foreach ($cartData as $val) {
                $cart_product_id[] = $val->product_id;
                $cartCount = $val->quantity + $cartCount;
                $total = $total + $val->price;
            }

        }
        // die;
        if ($cartCount == 0) {
            $cartMessage = 'Cart is empty.';
            return view('home.shoppingCart', [
                'cartMessage' => $cartMessage,
                'cartCount' => $cartCount,
                'loggedIn' => $loggedIn,
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
        if (!empty(Auth::user())) {
            $loggedInId = Auth::user()->id;
            $clearCart = Cart::where('user_id', $loggedInId);
            $clearCart->delete();
        }


        return redirect('/')->with('message', 'Order placed successfully.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('message', 'Logged out successfully.');
    }
}