<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Other;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OthersController extends Controller
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
        $allothers = Other::all();
        $allproducts = Product::all();
        $allusers = User::all();
        return view('admin.others', [
            'allothers' => $allothers,
            'allproducts' => $allproducts,
            'allusers' => $allusers,
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
        $allusers = User::all();
        return view('admin.addother', [
            'allproducts' => $allproducts,
            'allusers' => $allusers,
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
        $other = new Other;
        $other->product_id = $request->product_id;
        $other->user_id = $request->user_id;
        $other->like = $request->like;
        $other->submit = $request->submit;
        $other->star = $request->star;
        $other->save();
        return redirect()->action([OthersController::class, 'index']);
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
        $allproducts = Product::all();
        $allusers = User::all();
        $other = Other::where('other_id', $id)->first();
        return view('admin.editother', [
            'other' => $other,
            'allproducts' => $allproducts,
            'allusers' => $allusers,
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
        $other = Other::find($id);
        $other->product_id = $request->product_id;
        $other->user_id = $request->user_id;
        $other->like = $request->like;
        $other->submit = $request->submit;
        $other->star = $request->star;
        $other->save();
        return redirect()->action([OthersController::class, 'index']);
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
        $other = Other::find($id);
        $other->delete();
        return redirect()->action([OthersController::class, 'index']);
    }
}
