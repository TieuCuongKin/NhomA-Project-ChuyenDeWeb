<?php

namespace App\Services;

use App\Enum\UserStatus;
use App\Enum\UserType;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Throwable;

class CompanyService
{
    /**
     * @var int
     */

    private int $status;

    /**
     * @var string
     */
    private string $message;

    /*
     * @var array
     */
    private array $data = [];

    private UserRepositoryInterface $userRepository;

    private CompanyRepositoryInterface $companyRepository;

    /**
     * @param UserRepositoryInterface    $userRepository
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        CompanyRepositoryInterface $companyRepository
    ) {
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
        $this->data = [];
    }

    public function getListCompany(?string $search = "", int $perPage = 10): LengthAwarePaginator
    {
        return $this->companyRepository->getAllCompany($search, $perPage, ['user']);
    }

    /**
     * @throws Exception
     */
    public function createNewCompany($param): array
    {
        DB::beginTransaction();
        try {
            $userData = [
                'email' => $param['email'],
                'password' => encrypt($param['password']),
                'status' => UserStatus::Active,
                'user_type_id' => UserType::Company,
            ];
            $user = $this->userRepository->create($userData);
            $companyData = [
                'user_id' => $user->id,
                'company_name' => $param['companyName'],
                'company_address' => $param['companyAddress'],
                'company_contact' => $param['companyContact'],
                'company_website' => $param['companyWebsite'],
                'description' => $param['companyDescription'],
                'image' => $param['thumb'],
            ];
            $this->companyRepository->create($companyData);
            $this->message = __('api_messages.user.successfully_updated');
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }

        return $this->handleApiResponse();
    }

    /**
     * @throws Exception
     */
    public function getCompanyById(int $id): array
    {
        $company = $this->companyRepository->findById($id, ['user']);
        if (!$company) throw new Exception('Company not found');
        $this->data['id'] = $id;
        $this->data['email'] = $company->user->email;
        $this->data['user_id'] = $company->user_id;
        $this->data['company_name'] = $company->company_name;
        $this->data['company_address'] = $company->company_address;
        $this->data['company_contact'] = $company->company_contact;
        $this->data['company_website'] = $company->company_website;
        $this->data['description'] = $company->description;
        $this->data['image'] = $company->image;

        return $this->data;
    }

    /**
     * @throws Exception
     */
    public function updateCompany(int $id, array $param): array
    {
        DB::beginTransaction();
        $company = $this->companyRepository->findById($id, ['user']);
        if (!$company) {
            $this->status = Response::HTTP_NOT_FOUND;
            $this->message = __('api_messages.user.not_found');

            return $this->handleApiResponse();
        }
        try {
            $userData = [
                'email' => $param['email'],
                'status' => $param['status'],
            ];
            $this->userRepository->update($company->user->id, $userData);
            $companyData = [
                'company_name' => $param['companyName'],
                'company_address' => $param['companyAddress'],
                'company_contact' => $param['companyContact'],
                'company_website' => $param['companyWebsite'],
                'description' => $param['companyDescription'],
                'image' => $param['thumb'],
            ];
            $this->companyRepository->update($id, $companyData);

            $this->message = __('api_messages.user.successfully_updated');
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }

        return $this->handleApiResponse();
    }

    /**
     * @throws Exception
     */
    public function deleteCompanyAccount(int $id): array
    {
        DB::beginTransaction();
        $company = $this->companyRepository->findById($id, ['user']);
        if (!$company) {
            $this->status = Response::HTTP_NOT_FOUND;
            $this->message = __('api_messages.user.not_found');

            return $this->handleApiResponse();
        }

        try {
            $this->companyRepository->delete($id);
            $this->userRepository->delete($company->user->id);
            $this->message = __('api_messages.user.successfully_delete');
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            throw new Exception(__('api_messages.failed'));
        }
        return $this->handleApiResponse();
    }

    /**
     * Format data
     *
     * @return array
     */
    public function handleApiResponse(): array
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data
        ];
    }
}