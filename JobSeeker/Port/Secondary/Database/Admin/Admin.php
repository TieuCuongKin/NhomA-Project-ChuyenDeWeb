<?php

namespace JobSeeker\Port\Secondary\Database\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JobSeeker\Domain\MasterManagement\Admin\Model\Admin as AdminDomainModel;

class Admin extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'admins';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_login',
        'remember_token',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Create Domain Model object from this model DAO
     */
    public function toDomainEntity ()
    {
        // TODO: Implement toDomainEntity() method.
        $admin = new AdminDomainModel(
            $this->name,
            $this->email,
            $this->password,
            $this->last_login,
            $this->remember_token,
        );
        $admin->setId($this->id);

        return $admin;
    }

    /**
     * Pull data from Domain Model object to this model DAO for saving
     * @param AdminDomainModel $admin
     */
    protected function fromDomainEntity($admin)
    {
        // TODO: Implement fromDomainEntity() method.
        $this->name = $admin->getName();
        $this->email = $admin->getEmail();
        $this->password = $admin->getPassword();

        return $this;
    }
}
