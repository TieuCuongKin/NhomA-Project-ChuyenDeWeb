<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Detail;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailsController extends Controller
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
        $alldetails = Detail::all();
        $allproducts = Product::all();
        $allpayments = Payment::all();
        return view('admin.details', [
            'alldetails' => $alldetails,
            'allproducts' => $allproducts,
            'allpayments' => $allpayments,
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
        $allproducts = Product::all();
        $allpayments = Payment::all();
        return view('admin.adddetail', [
            'allproducts' => $allproducts,
            'allpayments' => $allpayments,
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
        $detail = new Detail;
        $detail->product_id = $request->product_id;
        $detail->payment_id = $request->payment_id;
        $detail->quantity = $request->quantity;
        $detail->save();
        return redirect()->action([DetailsController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $allproducts = Product::all();
        $allpayments = Payment::all();
        $detail = Detail::where('detail_id', $id)->first();
        return view('admin.editdetail', [
            'detail' => $detail,
            'allproducts' => $allproducts,
            'allpayments' => $allpayments,
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
        $detail = Detail::find($id);
        $detail->product_id = $request->product_id;
        $detail->payment_id = $request->payment_id;
        $detail->quantity = $request->quantity;
        $detail->save();
        return redirect()->action([DetailsController::class, 'index']);
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
        $detail = Detail::find($id);
        $detail->delete();
        return redirect()->action([DetailsController::class, 'index']);
    }
}
