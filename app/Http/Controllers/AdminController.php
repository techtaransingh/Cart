<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    public function adminPanel(Request $request)
    {
        $loggedIn = Auth::user();

        return view('admin.home');
    }
    public function viewCategory(Request $request)
    {
        return view('admin.addCategory');
    }
    public function addCategory(Request $request)
    {
        // print_r($_REQUEST);

        $data = $request->validate(['category' => 'required']);

        $category = Category::create($data);
        return back()->with('success', 'Category added successfully.');
    }
    public function viewProduct(Request $request)
    {
        $categories = Category::all();
        // if ($categories->count() == 0) {
        //     return redirect('viewCategory')->with('message', 'Add category first.');
        // } else {
        return view('admin.addProduct', ['categories' => $categories]);
        // }
    }
    public function addProduct(Request $request)
    {

        $data = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
            'category_id' => 'required'

        ]);
        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('images'), $image);
            $data['image'] = $image;
        }

        $product = Product::create($data);
        return back()->with('success', 'Product added succesfully');

    }

    public function listCategories(Request $request)
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.listCategories', ['categories' => $categories]);


    }
    public function listProducts(Request $request)
    {

        $products = Product::all();

        $categories = Category::all();

        return view('admin.listProducts', ['products' => $products, 'categories' => $categories]);
    }
    public function deleteCategory(Request $request, $id)
    {

        $deleteCategory = Category::find($id)->delete();
        return back()->with('success', 'Category deleted successfully.');
    }
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
        ]);

        $category = Category::find($id);
        $category->category = $request->category;
        $category->save();

        return response()->json(['success' => true]);
    }
    public function deleteProduct(Request $request, $id)
    {
        $deleteProduct = Product::find($id)->delete();
        return back()->with('success', 'Product deleted Successfully.');
    }
    public function editProduct(Request $request)
    {
        // print_r($request->id);
        // $updateProduct = Product::find($id);'updateProduct' => $updateProduct,
        $categories = Category::all();
        $productValues = Product::find($request->id);
        // print_r($productValues);
        // die;
        return view('admin.editProduct', ['categories' => $categories, 'productValues' => $productValues]);


    }

}