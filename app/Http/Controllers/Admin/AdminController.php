<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Services\AdminService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    protected AdminService $adminService;

    /**
     * @param AdminService $adminService
     */
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function loginPage()
    {
        return view('admin.login');
    }

    public function loginRequest(AdminRequest $request): RedirectResponse
    {
        if($this->adminService->checkLogin($request->all()))
        {
            return redirect()->route('admin.index');
        }

        return redirect()->back();
    }

    public function logout(): RedirectResponse
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function index()
    {
        return view('admin.index');
    }
}
