<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\ResponseHandler\ApiResponseHandler;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    protected CompanyService $companyService;

    /**
     * @param CompanyService $companyService
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index(?Request $request)
    {
        $data = $this->companyService->getListCompany($request?->search);
        return view('admin.company.list',['companies' => $data]);
    }

    public function create()
    {
        return view('admin.company.add');
    }

    public function store(Request $request)
    {
        $this->companyService->createNewCompany($request->all());

        return redirect()->route('admin.company.list');

    }

    public function show($id)
    {
        $data = $this->companyService->getCompanyById($id);

        return view('admin.company.detail',['company' => $data]);
    }

    public function edit($id)
    {
        $data = $this->companyService->getCompanyById($id);

        return view('admin.company.edit',['company' => $data]);
    }

    public function update(Request $request, $id)
    {
        $this->companyService->updateCompany($id, $request->all());

        return redirect()->route('admin.company.list');
    }

    public function destroy($id)
    {
        if($this->companyService->deleteCompanyAccount($id))
        {
            return redirect()->route('admin.company.list');
        }

        return redirect()->back();
    }
}
