<?php
namespace Orion\User\Model;

use Orion\Framework\Database\DatabaseModel;

class UserModel extends DatabaseModel {

    protected $table = 'users';
    protected $primary = 'id';

    protected $fillables = [
        'username', 'password', 'mail', 'account_created', 'last_login', 'online', 'last_online', 'motto', 'look', 'gender', 'rank', 'credits', 'auth_ticket', 'avatar_bg', 'ip_register', 'ip_current'
    ];

}