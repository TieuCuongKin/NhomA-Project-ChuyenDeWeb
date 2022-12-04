<?php

namespace App\Services;

use App\Enum\UserStatus;
use App\Enum\UserType;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;
use Throwable;

class CompanyService
{
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

        $this->data = [];
    }

    public function getListCompany(?string $search = "", int $perPage = 10): LengthAwarePaginator
    {
        return $this->companyRepository->getAllCompany($search, $perPage, ['user']);
    }

    /**
     * @throws Exception
     */
    public function createNewCompany($param): bool
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
            Session::flash('success', 'Create company success');

            DB::commit();
            return true;
        } catch (Throwable $exception) {
            DB::rollBack();
            Session::flash('error', $exception->getMessage());
        }
        return false;
    }

    /**
     * @throws Exception
     */
    public function getCompanyById(int $id): array
    {
        $company = $this->companyRepository->findById($id, ['user']);
        if (!$company) {
            return Session::flash('error', 'Company Not Found');
        }
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
    public function updateCompany(int $id, array $param): bool
    {
        DB::beginTransaction();
        $company = $this->companyRepository->findById($id, ['user']);
        if (!$company) {
            Session::flash('error', 'Company Not Found');
            return false;
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
            Session::flash('success', 'Update Company Success');

            DB::commit();
            return true;
        } catch (Throwable $exception) {
            DB::rollBack();
            Session::flash('error', $exception->getMessage());
        }
        return false;
    }

    /**
     * @throws Exception
     */
    public function deleteCompanyAccount(int $id): bool
    {
        DB::beginTransaction();
        $company = $this->companyRepository->findById($id, ['user']);
        if (!$company) {
            Session::flash('success', 'Company Not Found');
            return false;
        }

        try {
            $this->companyRepository->delete($id);
            $this->userRepository->delete($company->user->id);
            Session::flash('success', 'Company Delete Success');

            DB::commit();
            return true;
        } catch (Throwable $exception) {
            DB::rollBack();
            Session::flash('error', $exception->getMessage());
        }
        return false;
    }
}