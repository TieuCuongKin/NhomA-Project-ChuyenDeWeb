<?php

namespace JobSeeker\Application\Admin\Services;

use JobSeeker\Port\Secondary\Database\Base\Admin\AdminRepositoryInterface;
use Illuminate\Support\Facades\Auth;

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
            return true;
        }
        return false;
    }


}