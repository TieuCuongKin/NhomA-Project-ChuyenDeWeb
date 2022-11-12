<?php

namespace JobSeeker\Application\Admin\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use JobSeeker\Domain\JobSeekerManagement\User\Enum\UserStatus;
use JobSeeker\Domain\JobSeekerManagement\User\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Response;
use JobSeeker\Port\Primary\ResponseHandler\Api\ApiResponseHandler;
use JobSeeker\Port\Secondary\Database\User\User;
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

    public function createNewUser($params)
    {

    }

    /**
     * @throws Exception
     */
    public function getUserById(int $id): array
    {
        $user = $this->userRepository->getUserById($id);
        if (!$user) throw new Exception('User not found');

        $this->data['id'] = $user->getId();
        $this->data['full_name'] = $user->getFullName();
        $this->data['gender'] = $user->getGender();
        $this->data['email'] = $user->getEmail();
        $this->data['phone'] = $user->getPhone();

        return $this->data;
    }

    /**
     * @throws Exception
     */
    public function updateUser(int $id, array $params): array
    {
        DB::beginTransaction();
        $userDomainModel = $this->userRepository->getUserById($id);

        if (!$userDomainModel) {
            $this->status = Response::HTTP_NOT_FOUND;
            $this->message = __('api_messages.user.not_found');

            return $this->handleApiResponse();
        }

        try {
            $userDomainModel->setEmail($params['email']);
            $userDomainModel->setFullName($params['fullname']);
            $userDomainModel->setGender($params['gender']);
            $userDomainModel->setPhone($params['phone']);

            $this->userRepository->save($userDomainModel);

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
        $userDomainModel = $this->userRepository->getUserById($id);
        if (!$userDomainModel) {
            $this->status = Response::HTTP_NOT_FOUND;
            $this->message = __('api_messages.user.not_found');

            return $this->handleApiResponse();
        }

        try {
            $userDomainModel->setStatus(UserStatus::Deactivate);
            $this->userRepository->save($userDomainModel);
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