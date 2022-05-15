<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Models\Product;

class ManufacturersController extends Controller
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
        $allmanus = Manufacturer::all();
        $allproducts = Product::all();
        return view('admin.manufacturers', [
            'allmanus' => $allmanus,
            'allproducts' => $allproducts,
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
        return view('admin.addmanufacturer');
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
        $manu = new Manufacturer;
        $manu->manu_name = $request->manu_name;
        $manu->save();
        return redirect()->action([ManufacturersController::class, 'index']);
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
        $manu = Manufacturer::where('manu_id', $id)->first();
        return view('admin.editmanufacturer', [
            'manu' => $manu,
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
        $manu = Manufacturer::find($id);
        $manu->manu_name = $request->manu_name;
        $manu->save();
        return redirect()->action([ManufacturersController::class, 'index']);
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
        $manu = Manufacturer::find($id);
        $manu->delete();
        return redirect()->action([ManufacturersController::class, 'index']);
    }
}
