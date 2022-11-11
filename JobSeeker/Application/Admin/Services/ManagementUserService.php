<?php

namespace JobSeeker\Application\Admin\Services;

use JobSeeker\Domain\JobSeekerManagement\User\Interfaces\UserRepositoryInterface;

class ManagementUserService
{
    protected UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getListUsers()
    {
        return $this->userRepository->getAll()->toArray();
    }
}