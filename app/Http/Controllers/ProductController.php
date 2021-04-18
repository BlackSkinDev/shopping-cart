<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
    	$products = Product::paginate(9);
    	return view('welcome',['products'=>$products]);
	}

    public function show(Product $product){
        return view('show',['product'=>$product]);

    }


    public function cart(){
        return view('cart');
    }


    public function addToCart(Request $request,Product $product){

       // if cart is empty then this the first product
       $cart = session()->get('cart');

       if(!$cart) {
            $cart = [
                    $product->id => [
                        "title" => $product->title,
                        "quantity" => $request['quantity'],
                        "price" => $product->price,
                        "total_price"=>$product->price * $request['quantity'],
                        "imagePath" => $product->imagePath
                    ]
            ];
            session()->put('cart', $cart);
            session()->put('grandPrice',$product->price  * $request['quantity']);
            session()->put('totalProducts',1);

            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if cart is not empty

        else{
            // if product exist in cart
            if(isset($cart[$product->id])) {
                $cart[$product->id]['quantity']+=$request['quantity'];
                $cart[$product->id]['total_price']+=$request['quantity'] * $product->price;
                session()->put('grandPrice', session()->get('grandPrice') + ($product->price * $request['quantity']));
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product added to cart successfully!');
            }
            // if product does not exist
            else{
                $cart[$product->id] = [
                        "title" => $product->title,
                        "quantity" => $request['quantity'],
                        "price" => $product->price,
                        "total_price"=>$product->price * $request['quantity'],
                        "imagePath" => $product->imagePath
                ];
                session()->put('cart', $cart);
                session()->put('grandPrice', session()->get('grandPrice') + ($product->price * $request['quantity']));
                session()->put('totalProducts',session()->get('totalProducts')+1);
                session()->flash('success', 'Product added to cart successfully!');
               return redirect()->back();
            }
        }
    }

    public function remove(Request $request){
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                session()->put('grandPrice', session()->get('grandPrice') - $cart[$request->id]['total_price']);
                session()->put('totalProducts',session()->get('totalProducts')-1);
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
            return json_encode($request->id);
        }
    }

    public function update(Request $request){
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
            session()->put('grandPrice', (session()->get('grandPrice')- $cart[$request->id]['total_price']) + ($cart[$request->id]['price'] * $request['quantity']));
           $cart[$request->id]["quantity"]= $request->quantity;
            $cart[$request->id]['total_price']=$request['quantity'] * $cart[$request->id]['price'];
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }




     public function session(){
        session()->flush();
         //dd(session()->all());

     }

}


