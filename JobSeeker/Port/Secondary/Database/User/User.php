<?php

namespace JobSeeker\Port\Secondary\Database\User;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JobSeeker\Domain\User\Model\User as UserDomainModel;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * Create Domain Model object from this model DAO
     */
    public function toDomainEntity ()
    {
        // TODO: Implement toDomainEntity() method.
        $user = new UserDomainModel(
            $this->full_name,
            $this->gender,
            $this->address,
            $this->phone,
            $this->email,
            $this->password,
            $this->status,
            $this->user_type_id,
            $this->remember_token
        );
        $user->setId($this->id);

        return $user;
    }

    /**
     * Pull data from Domain Model object to this model DAO for saving
     * @param UserDomainModel $user
     */
    protected function fromDomainEntity($user)
    {
        // TODO: Implement fromDomainEntity() method.
        $this->full_name = $user->getFullName();
        $this->gender = $user->getGender();
        $this->address = $user->getAddress();
        $this->phone = $user->getPhone();
        $this->email = $user->getEmail();
        $this->password = $user->getPassword();
        $this->status = $user->getStatus();
        $this->user_type_id = $user->getUserTypeId();
        $this->remember_token = $user->getRememberToken();

        return $this;
    }
}
