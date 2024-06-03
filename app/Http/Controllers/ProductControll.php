<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Reaction;
use App\Policies\ProductPolicy;
use App\Policies\UserPolicy;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductControll extends Controller
{
    use AuthorizesRequests;
    protected $ProductPolicy;

    public function __construct(ProductPolicy $ProductPolicy)
    {
        $this->ProductPolicy = $ProductPolicy;
    }

    public function myproduct($id) {
        $user_id = User::findOrFail($id);
        $user_products = $user_id->products()->paginate(8);

        return view('ResSite.MyProduct',compact('user_products'));
    }

    public function index(){

        return view('ResSite.index',
        ['pageTitle'=>'All Product',
        'products'=>Product::paginate(8)
    ]);}

    public function create(){
        return view('ResSite.create',
        ['pageTitle'=>'Create']
    );
    }

    public function store(Request $request){

        if (!auth()->guard('user')->check()) {
            return redirect()->route('user.loginuser')->with('loginError', 'You must be logged in to add a product.');
        }

        // Proceed with validation
        $validatedData = $request->validate([
            'productName' => 'required|string|max:255',
            'productUrl' => 'required|url',
            'productPrice' => 'required|numeric|between:0.01,9999.99'
        ]);

        // Prepare data for insertion
        $CRdata = [
            'gameName' => strip_tags($request->input('productName')),
            'slug' => Str::slug($request->input('productName')),
            'imageUrl' => strip_tags($request->input('productUrl')),
            'price' => strip_tags($request->input('productPrice')),
            'user_id' => auth()->guard('user')->user()->id,

        ];

        // Create product and redirect with success message
        Product::create($CRdata);
        return redirect()->route('product.index')->with('success-create', 'Success add ' . $request->input('productName') . '.');
    }



    public function show(string $slug){

        $product = Product::where('slug', $slug)->firstOrFail();

        return view('ResSite.show',
        ['pageTitle'=>'Show Page',
        'Vshow' => $product]);
    }

    public function edit(string $id) {
        $product = Product::findOrFail($id);
        $authuser = auth()->guard('user')->user();

        if (!$this->ProductPolicy->view($authuser, $product)) {
            return abort(403);
        }

        return view('ResSite.edit', [
            'pageTitle' => 'Edit Page',
            'product' => $product
        ]);
    }



    public function update(Request $request, string $id){

        $product = Product::findOrFail($id);
        $authuser = auth()->guard('user')->user();

        if (!$this->ProductPolicy->view($authuser, $product)) {
            return abort(403);
        }

        $request->validate([
            'productName' => ['required','string','max:255'],
            'productUrl' => ['required','url'],
            'productPrice' => ['required','numeric','between:0.01,9999.99']
        ]);

        $product->gameName = strip_tags($request->input('productName'));
        $product->imageUrl = strip_tags($request->input('productUrl'));
        $product->price = strip_tags($request->input('productPrice'));
        $product->save();
        return redirect()->route('product.index');

    }


    public function destroy(string $id){

        $product = Product::findOrFail($id);
        $authuser = auth()->guard('user')->user();

        if (!$this->ProductPolicy->view($authuser, $product)) {
            return response()->view('ErrorPages.403', [] ,403);
        }

        $product->delete();
        return redirect()->route('product.index');
    }

}
