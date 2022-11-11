<?php

namespace JobSeeker\Port\Primary\Controllers\Admin;

use App\Http\Controllers\Controller;
use JobSeeker\Application\Admin\Services\ManagementUserService;

class UserController extends Controller
{
    protected ManagementUserService $managementUserService;

    /**
     * @param ManagementUserService $managementUserService
     */
    public function __construct(ManagementUserService $managementUserService)
    {
        $this->managementUserService = $managementUserService;
    }


    public function listUsers()
    {
        $data = $this->managementUserService->getListUsers();

        return view('admin.jobseeker.list',$data);
    }
}