<?php

namespace JobSeeker\Application\Admin\Services;

use Illuminate\Support\Facades\Auth;
use JobSeeker\Domain\MasterManagement\Admin\Interfaces\AdminRepositoryInterface;

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