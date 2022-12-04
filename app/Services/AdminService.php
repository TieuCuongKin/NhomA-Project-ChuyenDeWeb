<?php

namespace App\Services;

use App\Repositories\AdminRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminService
{
    protected AdminRepositoryInterface $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function checkLogin(array $request): bool
    {
        $params = [
            'email' => $request['email'],
            'password' => $request['password']
        ];
        if(Auth::guard('admin')->attempt($params)) {
            Session::flash('success', 'Login successfully');
            return true;
        }
        Session::flash('error', 'Wrong account or password');
        return false;
    }


}