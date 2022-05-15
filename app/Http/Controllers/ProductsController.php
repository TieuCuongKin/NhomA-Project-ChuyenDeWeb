<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Models\Other;
use App\Models\Product;
use App\Models\Detail;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function userCan($action, $option = NULL)
    {
        $user = Auth::user();
        return Gate::forUser($user)->allows($action, $option);
    }

    public function index()
    {
        if (!$this->userCan('view-page-admin')) {
            abort('403', __('Bạn không có quyền thực hiện thao tác này'));
        }
        $allproducts = Product::orderBy('product_id', 'desc')->get();
        $allmanus = Manufacturer::all();
        $allothers = Other::all();
        $alldetails = Detail::all();
        return view('admin.products', [
            'allproducts' => $allproducts,
            'allmanus' => $allmanus,
            'allothers' => $allothers,
            'alldetails' => $alldetails,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->userCan('view-page-admin')) {
            abort('403', __('Bạn không có quyền thực hiện thao tác này'));
        }
        $allmanus = Manufacturer::all();
        return view('admin.addproduct', [
            'allmanus' => $allmanus,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$this->userCan('view-page-admin')) {
            abort('403', __('Bạn không có quyền thực hiện thao tác này'));
        }
        $product = new Product;
        $product->manu_id = $request->manu_id;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->image = $request->file('image')->getClientOriginalName();
        $request->file('image')->move('img', $request->file('image')->getClientOriginalName(), 'local');
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->feature = $request->feature;
        $product->sale = $request->sale;
        $product->star = $request->star;
        $product->created_at = $request->created_at;
        $product->save();
        return redirect()->action([ProductsController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$this->userCan('view-page-admin')) {
            abort('403', __('Bạn không có quyền thực hiện thao tác này'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$this->userCan('view-page-admin')) {
            abort('403', __('Bạn không có quyền thực hiện thao tác này'));
        }
        $allmanus = Manufacturer::all();
        $product = Product::where('product_id', $id)->first();
        return view('admin.editproduct', [
            'allmanus' => $allmanus,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$this->userCan('view-page-admin')) {
            abort('403', __('Bạn không có quyền thực hiện thao tác này'));
        }
        $product = Product::find($id);
        $product->manu_id = $request->manu_id;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        if ($request->file('image') != null) {
            $product->image = $request->file('image')->getClientOriginalName();
            $request->file('image')->move('img', $request->file('image')->getClientOriginalName(), 'local');
        }
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->feature = $request->feature;
        $product->sale = $request->sale;
        $product->star = $request->star;
        $product->created_at = $request->created_at;
        $product->save();
        return redirect()->action([ProductsController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$this->userCan('view-page-admin')) {
            abort('403', __('Bạn không có quyền thực hiện thao tác này'));
        }
        $product = Product::find($id);
        $product->delete();
        // unlink('img/' . $product->image);
        return redirect()->action([ProductsController::class, 'index']);
    }
}
