<?php

namespace App\Services;

use App\Models\User;
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

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->status = Response::HTTP_OK;
        $this->message = __('api_messages.successful');
        $this->data = [];
    }

    public function getListUsers(?string $search = "", int $perPage = 10, ?array $ids = null)
    {
        return $this->userRepository->getAllUser($search, $perPage, $ids);
    }

    /**
     * @throws Exception
     */
    public function createNewUser($param): array
    {
        DB::beginTransaction();
        $password = encrypt($param['password']);
        $param['status'] = 1;
        $param['user_type_id'] = 1;
        try {
            $user = [
                $param['fullname'],
                $param['gender'],
                $param['address'],
                $param['phone'],
                $param['email'],
                $password,
                $param['status'],
                $param['user_type_id'],
            ];

            $this->userRepository->create($user);
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
    public function getUserById(int $id): array
    {
        $user = $this->userRepository->findById($id);
        if (!$user) throw new Exception('User not found');

        $this->data['id'] = $user->id;
        $this->data['full_name'] = $user->full_name;
        $this->data['gender'] = $user->gender;
        $this->data['email'] = $user->email;
        $this->data['phone'] = $user->phone;
        $this->data['address'] = $user->address;
        $this->data['status'] = $user->status;

        return $this->data;
    }

    /**
     * @throws Exception
     */
    public function updateUser(int $id, array $params): array
    {
        DB::beginTransaction();
        $userDomainModel = $this->userRepository->findById($id);

        if (!$userDomainModel) {
            $this->status = Response::HTTP_NOT_FOUND;
            $this->message = __('api_messages.user.not_found');

            return $this->handleApiResponse();
        }

        try {
            $array = [
                'email' => $params['email'],
                'full_name' => $params['fullname'],
                'gender' => $params['gender'],
                'phone' => $params['phone'],
                'address' => $params['address'],
                'status' => $params['status']
            ];
            $this->userRepository->update($id, $array);

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
        $userDomainModel = $this->userRepository->findById($id);
        if (!$userDomainModel) {
            $this->status = Response::HTTP_NOT_FOUND;
            $this->message = __('api_messages.user.not_found');

            return $this->handleApiResponse();
        }

        try {
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
     * Format Registration data
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