<?php

namespace App\Services;

use App\Enum\UserStatus;
use App\Enum\UserType;
use App\Repositories\UserDetailRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Throwable;

class ManagementUserService
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

    protected UserRepositoryInterface $userRepository;

    protected UserDetailRepositoryInterface $userDetailRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, UserDetailRepositoryInterface $userDetailRepository)
    {
        $this->userRepository = $userRepository;
        $this->userDetailRepository = $userDetailRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
        $this->data = [];
    }

    public function getListUsers(?string $search = "", int $perPage = 10)
    {
        return $this->userRepository->getAllUser($search, $perPage, ['userDetail']);
    }

    /**
     * @throws Exception
     */
    public function createNewUser($param): array
    {
        DB::beginTransaction();
        try {
            $userData = [
                'email' => $param['email'],
                'password' => encrypt($param['password']),
                'status' => UserStatus::Active,
                'user_type_id' => UserType::JobSeeker,
            ];
            $user = $this->userRepository->create($userData);
            $userDetailData = [
                'full_name' => $param['fullname'],
                'gender' => $param['gender'],
                'address' => $param['address'],
                'phone' => $param['phone'],
                'user_id' => $user->id,
            ];
            $this->userDetailRepository->create($userDetailData);
            $this->message = __('api_messages.user.successfully_updated');
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            $this->message = $exception;
        }

        return $this->handleApiResponse();
    }

    /**
     * @throws Exception
     */
    public function getUserById(int $id): array
    {
        $user = $this->userRepository->findById($id, ['userDetail']);
        if (!$user) throw new Exception('User not found');

        $this->data['id'] = $user->id;
        $this->data['full_name'] = $user->userDetail->full_name;
        $this->data['gender'] = $user->userDetail->gender;
        $this->data['email'] = $user->email;
        $this->data['phone'] = $user->userDetail->phone;
        $this->data['address'] = $user->userDetail->address;
        $this->data['status'] = $user->status;

        return $this->data;
    }

    /**
     * @throws Exception
     */
    public function updateUser(int $id, array $param): array
    {
        DB::beginTransaction();
        $user = $this->userRepository->findById($id, ['userDetail']);
        if (!$user) {
            $this->status = Response::HTTP_NOT_FOUND;
            $this->message = __('api_messages.user.not_found');

            return $this->handleApiResponse();
        }

        try {
            $userData = [
                'email' => $param['email'],
                'status' => $param['status'],
            ];
            $this->userRepository->update($id, $userData);
            $userDetailData = [
                'full_name' => $param['fullname'],
                'gender' => $param['gender'],
                'address' => $param['address'],
                'phone' => $param['phone'],
            ];
            $this->userDetailRepository->update($user->userDetail->id, $userDetailData);

            $this->message = __('api_messages.user.successfully_updated');
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            throw new Exception(__('api_messages.failed'));
        }

        return $this->handleApiResponse();
    }

    /**
     * @throws Exception
     */
    public function deleteUserAccount(int $id): array
    {
        DB::beginTransaction();
        $userDomainModel = $this->userRepository->findById($id, ['userDetail']);
        if (!$userDomainModel) {
            $this->status = Response::HTTP_NOT_FOUND;
            $this->message = __('api_messages.user.not_found');

            return $this->handleApiResponse();
        }

        try {
            $this->userDetailRepository->delete($userDomainModel->userDetail->id);
            $this->userRepository->delete($id);
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