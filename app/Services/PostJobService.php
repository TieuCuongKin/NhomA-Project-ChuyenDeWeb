<?php

namespace App\Services;

use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\PostJobRepositoryInterface;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Throwable;

class PostJobService
{
    /*
     * @var array
     */
    private array $data = [];

    private PostJobRepositoryInterface $postJobRepository;

    private CompanyRepositoryInterface $companyRepository;

    /**
     * @param PostJobRepositoryInterface    $postJobRepository
     * @param CompanyRepositoryInterface $companyRepository
     */
    public function __construct(
        PostJobRepositoryInterface $postJobRepository,
        CompanyRepositoryInterface $companyRepository
    ) {
        $this->postJobRepository = $postJobRepository;
        $this->companyRepository = $companyRepository;

        $this->data = [];
    }

    public function getListJobs(?string $search = "", int $perPage = 10): LengthAwarePaginator
    {
        return $this->postJobRepository->getAllJobs($search, $perPage, ['company', 'location']);
    }

    /**
     * @throws Exception
     */
    public function createNewJob($param): bool
    {
        DB::beginTransaction();
        try {
            $jobData = [
                'job_title' => $param['title'],
                'company_id' => $param['company'],
                'job_location_id' => $param['job_location_id'],
                'job_salary_min' => $param['salary_min'],
                'job_salary_max' => $param['salary_max'],
                'job_description' => $param['job_description'],
                'job_expired_at' => $param['job_expiry'],
                'job_status' => $param['status'],
            ];
            $this->postJobRepository->create($jobData);

            Session::flash('success', 'Post job success');

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
    public function getJobById(int $id): array
    {
        $job = $this->postJobRepository->findById($id, ['company', 'location']);
        if (!$job) {
            return Session::flash('error', 'Job Not Found');
        }
        $this->data['id'] = $id;
        $this->data['job_title'] = $job->job_title;
        $this->data['company_name'] = $job->company->company_name;
        $this->data['company_id'] = $job->company->id;
        $this->data['company_description'] = $job->company->description;
        $this->data['images'] = $job->company->image;
        $this->data['job_location'] = $job->location->location_name;
        $this->data['job_location_id'] = $job->location->id;
        $this->data['job_salary_min'] = $job->job_salary_min;
        $this->data['job_salary_max'] = $job->job_salary_max;
        $this->data['job_description'] = $job->job_description;
        $this->data['job_expired_at'] = $job->job_expired_at;
        $this->data['job_status'] = $job->job_status;

        return $this->data;
    }

    /**
     * @throws Exception
     */
    public function updateJob(int $id, array $param): bool
    {
        DB::beginTransaction();
        $job = $this->postJobRepository->findById($id, ['user']);
        if (!$job) {
            Session::flash('error', 'Job Not Found');
            return false;
        }
        try {
            $jobData = [
                'job_title' => $param['title'],
                'company_id' => $param['company'],
                'job_location_id' => $param['job_location_id'],
                'job_salary_min' => $param['salary_min'],
                'job_salary_max' => $param['salary_max'],
                'job_description' => $param['job_description'],
                'job_expired_at' => $param['job_expiry'],
                'job_status' => $param['status'],
            ];
            $this->postJobRepository->update($job->id, $jobData);
            Session::flash('success', 'Update Job Success');

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
    public function deleteJob(int $id): bool
    {
        DB::beginTransaction();
        $company = $this->postJobRepository->findById($id, ['user']);
        if (!$company) {
            Session::flash('success', 'Job Not Found');
            return false;
        }

        try {
            $this->postJobRepository->delete($id);
            Session::flash('success', 'Job Delete Success');

            DB::commit();
            return true;
        } catch (Throwable $exception) {
            DB::rollBack();
            Session::flash('error', $exception->getMessage());
        }
        return false;
    }
}