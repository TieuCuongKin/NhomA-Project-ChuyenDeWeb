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
        $this->status = Response::HTTP_OK;;
        $this->message = __('api_messages.successful');
        $this->data = [];
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
        $this->data = $this->companyService->createNewCompany($request->all());

        return redirect()->route('admin.company.list');

    }

    public function show($id)
    {
        $this->data = $this->companyService->getCompanyById($id);

        return view('admin.company.detail',['company' => $this->data]);
    }

    public function edit($id)
    {
        $this->data = $this->companyService->getCompanyById($id);

        return view('admin.company.edit',['company' => $this->data]);
    }

    public function update(Request $request, $id)
    {
        $response = $this->companyService->updateCompany($id, $request->all());
        $this->setResponse($response['status'], $response['message'], $response['data']);

        return redirect()->route('admin.company.list');
    }

    public function destroy($id): JsonResponse
    {
        $response = $this->companyService->deleteCompanyAccount($id);
        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }

    /**
     * Set response for the controller
     *
     * @param int $status
     * @param string $message
     * @param array $data
     */
    public function setResponse(int $status, string $message, array $data)
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }
}
