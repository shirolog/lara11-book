<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

//registerページに関する記述

    public function register(){

        return view('register');
    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:3',
            'password_confirmation' => 'required',
        ]);

        if($validator->fails()){

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('user.login')->with('success', 'Registerd successfully!');
    }



//loginページに関する記述

    public function login(){

        return view('login');
    }


    public function authenticate(Request $request){

        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){

            return redirect()->route('user.login')->withInput()->withErrors($validator);
        }

        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){

            if(Auth::user()->role == 'user'){

                return redirect()->route('user.home');

            }elseif(Auth::user()->role == 'admin'){
                
                return redirect()->route('admin.admin_page');
            }
            
        }else{

            return redirect()->route('user.login')->with('error', 'Email or password incorrect!');
        }
    }



//homeページに関する記述

    public function home(){

        if(Auth::check()){
            $cart_total = Cart::where('user_id', Auth::user()->id)->count();
        }else{
            $cart_total = 0;
        }

        $products = Product::orderBy('created_at', 'ASC')->paginate(6);

        return view('home', compact('cart_total', 'products'));
    }

    public function add_cart(Request $request){

        $validator = Validator::make($request->all(), [

            'product_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|min:1|max:99',
            'image' => 'required|string',
        ]);

        if($validator->fails()){

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $existCart = Cart::where('user_id', Auth::user()->id)
        ->where('name', $request->input('name'))->get();

        if ($existCart->isNotEmpty()) {
            return redirect()->back()->with('error', 'already added to cart!');
        }

        $cart = new Cart;

        $cart->user_id = Auth::user()->id;
        $cart->product_id = $request->input('product_id');
        $cart->name = $request->input('name');
        $cart->price = str_replace(',', '', $request->input('price'));
        $cart->quantity = $request->input('quantity');
        $cart->image = $request->input('image');
        $cart->save();

        return redirect()->back()->with('success', 'Cart added successfully!');
    }


//aboutページに関する記述

    public function about(){

        if(Auth::check()){
            $cart_total = Cart::where('user_id', Auth::user()->id)->count();
        }else{
            $cart_total = 0;
        }

        return view('about', compact('cart_total'));
    }



//shopページに関する記述

    public function shop(){

        if(Auth::check()){
            $cart_total = Cart::where('user_id', Auth::user()->id)->count();
        }else{
            $cart_total = 0;
        }

        $products = Product::orderBy('created_at', 'ASC')->paginate(12);

        return view('shop', compact('cart_total', 'products'));
    }




//contactページに関する記述

    public function contact(){

        if(Auth::check()){
            $cart_total = Cart::where('user_id', Auth::user()->id)->count();
        }else{
            $cart_total = 0;
        }

        return view('contact', compact('cart_total'));
    }


    public function contact_store(Request $request){

        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required|numeric|min:10',
            'message' => 'required|string',
        ]);

        if($validator->fails()){

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $existMessage = Message::where('name', $request->input('name'))
        ->where('email', $request->input('email'))
        ->where('number', $request->input('number'))
        ->where('message', $request->input('message'))->get();

        if($existMessage->isNotEmpty()){

            return redirect()->back()->with('error', 'Message sent already!');
        }

        $message = new Message;
        $message->user_id = Auth::user()->id;
        $message->name = $request->input('name');
        $message->email = $request->input('email');
        $message->number = $request->input('number');
        $message->message = $request->input('message');
        $message->save();

        return redirect()->back()->with('success', 'Message sent successfully!');
    }



//cartページに関する記述

    public function cart(){

        if(Auth::check()){
            $cart_total = Cart::where('user_id', Auth::user()->id)->count();            
        }else{
            $cart_total = 0;
        }

        $carts = Cart::where('user_id', Auth::user()->id)->paginate(12);

        $total_price = $carts->sum(function($cart){
            return $cart->price * $cart->quantity;
        });


        return view('cart', compact('cart_total', 'carts', 'total_price'));
    }

    public function cart_update(Request $request, Cart $cart){

        $validator = Validator::make($request->all(), [

            'quantity' => 'required|min:1|max:99',
        ]);

        if($validator->fails()){

            return redirect()->back()->withInput()->withErrors($validator);
        }

        $cart->quantity = $request->input('quantity');
        $cart->save();

        return redirect()->back()->with('success', 'Cart quantity updated!');
    }



    public function  cart_destroy(Cart $cart){

        $cart->delete();

        session()->flash('success', 'Delete form cart successfully!');

        return response()->json([

            'status'=> true,
        ]);
    }


    public function cart_all_destroy(){

        Cart::where('user_id', Auth::user()->id)->delete();

        session()->flash('success', 'All product deleted successfully!');

        return response()->json([

            'status' => true,
        ]);

    }


//checkoutページに関する記述

    public function checkout(){

        
        if(Auth::check()){
            $cart_total = Cart::where('user_id', Auth::user()->id)->count();            
        }else{
            $cart_total = 0;
        }

        $carts = Cart::where('user_id', Auth::user()->id)->get();

        $total_price = $carts->sum(function($cart){
            return $cart->price * $cart->quantity;
        });

        return view('checkout', compact('cart_total', 'carts', 'total_price'));
    }

    public function checkout_store(Request $request){

        $validator = Validator::make($request->all(), [

            'name' => 'required|string|max:255',
            'number' => 'required|digits:10',
            'email' => 'required|email',
            'method' => 'required|in:cash on delivery,credit card,paypal,paytm',
            'flat' => 'required|integer|min:0',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'pin_code' => 'required|digits:6',
        ]);

        if($validator->fails()){

            return redirect()->back()->withInput()->withErrors($validator);
        }


        $productNames = $request->input('productName');
        $quantities = $request->input('quantity');
        $total_products = []; 

        foreach($productNames as $index => $productName){

            $quantity = $quantities[$index];
            $total_products[] = "{$productName} ({$quantity})";
        }

        $total_products_str = implode(',', $total_products);


        $flat = $request->input('flat');
        $street = $request->input('street');
        $city = $request->input('city');
        $state = $request->input('state');
        $country = $request->input('country');
        $pin_code = $request->input('pin_code');

        $address = $flat. ','. $street. ','. $city. ','. $state. ','. $country. '-'. $pin_code;


        
        $existOrder = Order::where('user_id', Auth::user()->id)
        ->where('name', $request->input('name'))
        ->where('number', $request->input('number'))
        ->where('email', $request->input('email'))
        ->where('method', $request->input('method'))
        ->where('address', $address)
        ->where('total_products', $total_products_str)
        ->where('total_price', $request->input('total_price'))->get();

        if($existOrder->isNotEmpty()){

            return redirect()->back()->with('error', 'Order already placed!');
        }

        $order = new Order;

        $order->user_id = Auth::user()->id;
        $order->name = $request->input('name');
        $order->number = $request->input('number');
        $order->email = $request->input('email');
        $order->method = $request->input('method');
        $order->address = $address;
        $order->total_products = $total_products_str;
        $order->total_price = $request->input('total_price');
        $order->placed_on = date('Y-m-d');
        $order->save();

        Cart::where('user_id', Auth::user()->id)->delete();

        return redirect()->back()->with('success', 'Order placed successfully!');

    }



//ordersページに関する記述

    public function orders(){

        if(Auth::check()){
            $cart_total = Cart::where('user_id', Auth::user()->id)->count();
        }else{
            $cart_total = 0;
        }

        $orders = Order::where('user_id', Auth::user()->id)->get();

        return view('orders', compact('cart_total', 'orders'));
    }

//search_pageページに関する記述

    public function search_page(Request $request){

        if(Auth::check()){
            $cart_total = Cart::where('user_id', Auth::user()->id)->count();
        }else{
            $cart_total = 0;
        }

        $serch_box= $request->input('search');

        if(!empty($serch_box)){

            $products = Product::where('name', '%'.$serch_box.'%')->paginate(6)->appends(['serch_box' => $serch_box]);

            
        }else{
            $products = collect();
        }


        return view('search_page', compact('cart_total', 'products'));
    }

//logout処理に関する記述

    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }    

}
