<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\LocationRepositoryInterface;
use App\Repositories\PostJobRepositoryInterface;
use App\Repositories\UserDetailRepositoryInterface;
use App\Services\AdminService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    protected AdminService $adminService;

    private UserDetailRepositoryInterface $userDetailRepository;

    private CompanyRepositoryInterface $companyRepository;

    private LocationRepositoryInterface $locationRepository;

    private PostJobRepositoryInterface $postjobRepository;

    /**
     * @param AdminService $adminService
     */
    public function __construct(
        AdminService $adminService,
        UserDetailRepositoryInterface $userDetailRepository,
        CompanyRepositoryInterface $companyRepository,
        LocationRepositoryInterface $locationRepository,
        PostJobRepositoryInterface $postjobRepository
    ){
        $this->adminService = $adminService;
        $this->userDetailRepository = $userDetailRepository;
        $this->companyRepository = $companyRepository;
        $this->locationRepository = $locationRepository;
        $this->postjobRepository = $postjobRepository;
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
        $companies = $this->companyRepository->getAll()->count();
        $locations = $this->locationRepository->getAll()->count();
        $jobseekers = $this->userDetailRepository->getAll()->count();
        $jobs = $this->postjobRepository->getAll()->count();

        return view('admin.index', [
            'companies' => $companies,
            'locations' => $locations,
            'jobseekers' => $jobseekers,
            'jobs' => $jobs
        ]);
    }
}