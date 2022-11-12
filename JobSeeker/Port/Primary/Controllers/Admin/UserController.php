<?php

namespace JobSeeker\Port\Primary\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JobSeeker\Application\Admin\Services\ManagementUserService;
use JobSeeker\Port\Primary\ResponseHandler\Api\ApiResponseHandler;

class UserController extends Controller
{
    protected ManagementUserService $managementUserService;

    /**
     * @param ManagementUserService $managementUserService
     */
    public function __construct(ManagementUserService $managementUserService)
    {
        $this->managementUserService = $managementUserService;
        $this->status = Response::HTTP_OK;;
        $this->message = __('api_messages.successful');
        $this->data = [];
    }

    public function listUsers()
    {
        $data = $this->managementUserService->getListUsers();

        return view('admin.jobseeker.list',['jobseekers' => $data]);
    }

    public function create()
    {
        return view('admin.jobseeker.add');
    }

    public function store(UserRequest $request)
    {
        $this->data = $this->managementUserService->createNewUser($request->all());

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }

    public function edit(int $id)
    {
        $this->data = $this->managementUserService->getUserById($id);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }

    /**
     * @throws Exception
     */
    public function update(Request $request, int $id)
    {
        $response = $this->managementUserService->updateUser($id, $request->all());
        $this->setResponse($response['status'], $response['message'], $response['data']);

        return ApiResponseHandler::jsonResponse($this->status, $this->message, $this->data);
    }

    /**
     * @throws Exception
     */
    public function delete($id)
    {
        $response = $this->managementUserService->deleteUserAccount($id);
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