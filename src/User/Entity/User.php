<?php declare(strict_types=1);

namespace Orion\User\Entity;

use Orion\Framework\Model\DataObject;
use Orion\User\Interfaces\UserInterface;

/**
 * Class User
 *
 * @package Ares\User\Entity
 */
class User extends DataObject implements UserInterface
{
    /** @var string */
    public const TABLE = 'users';

    /** @var array */
    public const HIDDEN = [
        UserInterface::COLUMN_PASSWORD,
        UserInterface::COLUMN_MAIL,
        UserInterface::COLUMN_AUTH_TICKET,
        UserInterface::COLUMN_IP_CURRENT,
        UserInterface::COLUMN_IP_REGISTER
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->getData(UserInterface::COLUMN_ID);
    }

    /**
     * @param int $id
     *
     * @return User
     */
    public function setId(int $id): User
    {
        return $this->setData(UserInterface::COLUMN_ID, $id);
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->getData(UserInterface::COLUMN_USERNAME);
    }

    /**
     * @param string $username
     *
     * @return User
     */
    public function setUsername(string $username): User
    {
        return $this->setData(UserInterface::COLUMN_USERNAME, $username);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->getData(UserInterface::COLUMN_PASSWORD);
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword(string $password): User
    {
        return $this->setData(UserInterface::COLUMN_PASSWORD, $password);
    }

    /**
     * @return string
     */
    public function getMail(): string
    {
        return $this->getData(UserInterface::COLUMN_MAIL);
    }

    /**
     * @param string $mail
     *
     * @return User
     */
    public function setMail(string $mail): User
    {
        return $this->setData(UserInterface::COLUMN_MAIL, $mail);
    }

    /**
     * @return string
     */
    public function getLook(): string
    {
        return $this->getData(UserInterface::COLUMN_LOOK);
    }

    /**
     * @param string $look
     *
     * @return User
     */
    public function setLook(string $look): User
    {
        return $this->setData(UserInterface::COLUMN_LOOK, $look);
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->getData(UserInterface::COLUMN_GENDER);
    }

    /**
     * @param string $gender
     *
     * @return User
     */
    public function setGender(string $gender): User
    {
        return $this->setData(UserInterface::COLUMN_GENDER, $gender);
    }

    /**
     * @return string|null
     */
    public function getMotto(): ?string
    {
        return $this->getData(UserInterface::COLUMN_MOTTO);
    }

    /**
     * @param string|null $motto
     *
     * @return User
     */
    public function setMotto(?string $motto): User
    {
        return $this->setData(UserInterface::COLUMN_MOTTO, $motto);
    }

    /**
     * @return int
     */
    public function getCredits(): int
    {
        return $this->getData(UserInterface::COLUMN_CREDITS);
    }

    /**
     * @param int $credits
     *
     * @return User
     */
    public function setCredits(int $credits): User
    {
        return $this->setData(UserInterface::COLUMN_CREDITS, $credits);
    }

    /**
     * @return int|null
     */
    public function getRank(): ?int
    {
        return $this->getData(UserInterface::COLUMN_RANK);
    }

    /**
     * @param int|null $rank
     *
     * @return User
     */
    public function setRank(?int $rank): User
    {
        return $this->setData(UserInterface::COLUMN_RANK, $rank);
    }

    /**
     * @return string|null
     */
    public function getAuthTicket(): ?string
    {
        return $this->getData(UserInterface::COLUMN_AUTH_TICKET);
    }

    /**
     * @param string|null $authTicket
     *
     * @return User
     */
    public function setAuthTicket(?string $authTicket): User
    {
        return $this->setData(UserInterface::COLUMN_AUTH_TICKET, $authTicket);
    }

    /**
     * @return string
     */
    public function getIpRegister(): string
    {
        return $this->getData(UserInterface::COLUMN_IP_REGISTER);
    }

    /**
     * @param string $ipRegister
     *
     * @return User
     */
    public function setIpRegister(string $ipRegister): User
    {
        return $this->setData(UserInterface::COLUMN_IP_REGISTER, $ipRegister);
    }

    /**
     * @return string|null
     */
    public function getIpCurrent(): ?string
    {
        return $this->getData(UserInterface::COLUMN_IP_CURRENT);
    }

    /**
     * @param string|null $ipCurrent
     *
     * @return User
     */
    public function setIpCurrent(?string $ipCurrent): User
    {
        return $this->setData(UserInterface::COLUMN_IP_CURRENT, $ipCurrent);
    }

    /**
     * @return int
     */
    public function getOnline(): int
    {
        return $this->getData(UserInterface::COLUMN_ONLINE);
    }

    /**
     * @param int $online
     *
     * @return User
     */
    public function setOnline(int $online): User
    {
        return $this->setData(UserInterface::COLUMN_ONLINE, $online);
    }

    /**
     * @return int
     */
    public function getLastLogin(): int
    {
        return $this->getData(UserInterface::COLUMN_LAST_LOGIN);
    }

    /**
     * @param int $lastLogin
     *
     * @return User
     */
    public function setLastLogin(int $lastLogin): User
    {
        return $this->setData(UserInterface::COLUMN_LAST_LOGIN, $lastLogin);
    }

    /**
     * @return int|null
     */
    public function getLastOnline(): ?int
    {
        return $this->getData(UserInterface::COLUMN_LAST_ONLINE);
    }

    /**
     * @param int|null $lastOnline
     *
     * @return User
     */
    public function setLastOnline(?int $lastOnline): User
    {
        return $this->setData(UserInterface::COLUMN_LAST_ONLINE, $lastOnline);
    }


    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->getData(UserInterface::COLUMN_CREATED_AT);
    }

    /**
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt(\DateTime $createdAt): User
    {
        return $this->setData(UserInterface::COLUMN_CREATED_AT, $createdAt);
    }

    /**
     * @return int|NOTnull
     */
    public function getAccountCreated(): ?int
    {
        return $this->getData(UserInterface::COLUMN_ACCOUNT_CREATED);
    }

    /**
     * @param int|NOTnull $lastOnline
     *
     * @return User
     */
    public function setAccountCreated(?int $lastOnline): User
    {
        return $this->setData(UserInterface::COLUMN_ACCOUNT_CREATED, $lastOnline);
    }
}