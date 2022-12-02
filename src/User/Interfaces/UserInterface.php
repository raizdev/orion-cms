<?php
namespace Orion\User\Interfaces;

/**
 * Interface UserInterface
 *
 * @package Orion\Contracts\User
 */
interface UserInterface
{
    public const COLUMN_ID = 'id';
    public const COLUMN_USERNAME = 'username';
    public const COLUMN_PASSWORD = 'password';
    public const COLUMN_MAIL = 'mail';
    public const COLUMN_LAST_LOGIN = 'last_login';
    public const COLUMN_LAST_ONLINE = 'last_online';
    public const COLUMN_MOTTO = 'motto';
    public const COLUMN_LOOK = 'look';
    public const COLUMN_GENDER = 'gender';
    public const COLUMN_RANK = 'rank';
    public const COLUMN_CREDITS = 'credits';
    public const COLUMN_ONLINE = 'online';
    public const COLUMN_AUTH_TICKET = 'auth_ticket';
    public const COLUMN_IP_REGISTER = 'ip_register';
    public const COLUMN_IP_CURRENT = 'ip_current';
    public const COLUMN_ACCOUNT_CREATED = 'account_created';
}