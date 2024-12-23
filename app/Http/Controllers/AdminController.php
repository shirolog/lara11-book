<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{   

//admin_pageに関する記述
    public function admin_page(){

        $total_pending = Order::where('status', 'pending')->sum('total_price');
        $total_completed = Order::where('status', 'completed')->sum('total_price');
        $number_of_orders = Order::all()->count();
        $number_of_products = Product::all()->count();
        $number_of_users = User::where('role', 'user')->count();
        $number_of_admins = User::where('role', 'admin')->count();
        $total_users = User::all()->count();
        $number_of_messages = Message::all()->count();


        return view('admin.admin_page', compact('total_pending', 'total_completed', 'number_of_orders',
        'number_of_products', 'number_of_users', 'number_of_admins', 'total_users', 'number_of_messages'));
    }


//admin_productsページに関する記述
    public function admin_products(){

        $products = Product::orderBy('created_at', 'ASC')->get();

        return view('admin.admin_products', compact('products'));
    }



    public function admin_products_store(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric|gte:0',
            'image' => 'required|mimes:jpeg,jpg,png|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');

        if (!empty($request->file('image'))) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;
            $image->move(public_path('uploaded_img/'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->back()->with('success', 'Product added successfully!');

    }


    public function admin_products_delete(Product $product){

        $product->delete();

        $old_image = public_path('uploaded_img/'. $product->image);
        
        if(is_file($old_image)){
            unlink($old_image);
        }

        session()->flash('success', 'Product deleted successfully!');

        return response()->json([

            'status' => true,
        ]);
    }


    public function admin_products_edit(Product $product){

        return response()->json([

            'status' => true,
            'product' => $product,
        ]);
    }
    

    public function admin_products_update(Request $request, Product $product){

        $validator = Validator::make($request->all(), [
            'name' => 'nullable',
            'price' => 'nullable|numeric|gte:0',
            'image' => 'nullable|mimes:jpeg,jpg,png|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $product->name = $request->input('name');
        $product->price =  $request->input('price');
        $product->save();

        if(!empty($request->file('image'))){
            
            $old_image = public_path('uploaded_img/'. $product->image);

            if(is_file($old_image)){
                unlink($old_image);
            }

            $image = $request->input('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time(). '.'. $ext;
            $image->move(public_path('uploaded_img/'), $imageName);
            $product->image = $imageName;
            $product->save();
        }

        session()->flash('success', 'Product updated successfully!');

        return response()->json([

            'status' => true,
        ]);

        
    }




//admin_ordersページに関する記述
    public function admin_orders(){


        return view('admin.admin_orders');
    }


    
//admin_usersページに関する記述
    public function admin_users(){


        return view('admin.admin_users');
    }


//admin_contactsページに関する記述
    public function admin_contacts(){


        return view('admin.admin_contacts');
    }



// admin_logout処理に関する記述
    public function admin_logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }

}
