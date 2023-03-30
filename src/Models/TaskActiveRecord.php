<?php

namespace Models;

use Database\Connection;
use Exceptions\InvalidArgumentException;

class TaskActiveRecord
{
    protected $id;
    protected $username;
    protected $email;
    protected $date;
    protected $status;
    protected $text;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setUsername(string $username): void
    {
        $this->username = trim(strval($username));
    }
    public function setEmail(string $email): void
    {
        $this->email = trim(strval($email));
    }

    public function setStatus(string $status): void
    {
        $this->status = intval(boolval($status));
    }

    public function setText(string $text): void
    {
        $this->text = trim(strval($text));
    }

    protected static function getTableName(): string
    {
        return 'tasks';
    }

    public static function getById(int $id): ?self
    {
        $connection = Connection::getInstance();
        return $connection->getRow(
            'SELECT * FROM `' . static::getTableName() . '` WHERE `id`=:id',
            static::class,
            [':id' => $id]
        );
    }

    public function save(): void
    {
        $id = $this->getId();
        if ($id) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    public function insert(): void
    {
        if (empty($this->username)) {
            throw new InvalidArgumentException('Введите имя');
        }

        if (!preg_match("/^[a-zа-яё0-9 '\-]+$/ui", $this->username)) {
            throw new InvalidArgumentException('В имени использованы недопустимые символы');
        }

        if (mb_strlen($this->username) > 100) {
            throw new InvalidArgumentException('В имени использовано слишком много символов');
        }

        if (empty($this->email)) {
            throw new InvalidArgumentException('Введите email');
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email некорректен');
        }

        if (mb_strlen($this->email) > 100) {
            throw new InvalidArgumentException('В email использовано слишком много символов');
        }

        if (empty($this->text)) {
            throw new InvalidArgumentException('Введите текст задачи');
        }

        $connection = Connection::getInstance();
        $connection->runQuery(
            'INSERT INTO `' . static::getTableName() . '` (`username`, `email`, `text`) VALUES (:username, :email, :text)',
            [':username' => $this->username, ':email' => $this->email, ':text' => $this->text]
        );
    }

    public function update(): void
    {
        $connection = Connection::getInstance();
        $connection->runQuery(
            'UPDATE `' . static::getTableName() . '` SET `status`=:status, `text`=:text WHERE `id`=:id',
            [':id' => $this->id, ':status' => $this->status, ':text' => $this->text]
        );
    }

    public function delete(): void
    {
        $connection = Connection::getInstance();
        $connection->runQuery(
            'DELETE FROM `' . static::getTableName() . '` WHERE `id`=:id',
            [':id' => $this->id]
        );
    }

    public static function getPagesCount(int $itemsPerPage): int
    {
        $connection = Connection::getInstance();
        $count = $connection->getColumn('SELECT COUNT(*) FROM `' . static::getTableName() . '`');
        return (int)ceil($count / $itemsPerPage);
    }

    public static function getSortedTasks(int $currentPage, int $limit, string $sort, string $order): ?array
    {
        $columns = ['username', 'email', 'date', 'status'];
        $sort = (in_array($sort, $columns)) ? $sort : 'date';
        $order = ($order === 'DESC') ? $order : 'ASC';
        $offset = ($currentPage - 1) * $limit;
        $connection = Connection::getInstance();
        return $connection->getRows(
            'SELECT * FROM `' . static::getTableName() . "` ORDER BY `$sort` $order LIMIT $limit OFFSET $offset",
            static::class
        );
    }
}
