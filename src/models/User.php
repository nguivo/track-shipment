<?php

namespace app\models;

use framework\core\Application;
use framework\core\db\DbModel;
use framework\core\UserModel;

class User extends UserModel
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;
    public const STATUS_DELETED = 2;

    public string $fname = '';
    public string $lname = '';
    public int $status = self::STATUS_INACTIVE;
    public string $email = '';
    public string $pass = '';
    public string $rpass = '';


    public function rules(): array
    {
        return[
            'fname' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3], [self::RULE_MAX, 'max' => 30]],
            'lname' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 30]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'pass' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6]],
            'rpass' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'pass']],
        ];
    }


    public function labels(): array
    {
        return [
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'email' => 'Email',
            'pass' => 'Password',
            'rpass' => 'Confirm Password'
        ];
    }


    public function save(): bool
    {
        $this->pass = password_hash($this->pass, PASSWORD_DEFAULT);
        return parent::save();
    }


    public function tableName(): string
    {
        return "users";
    }


    public function attributes(): array
    {
        return ['fname', 'lname', 'email', 'pass', 'status'];
    }


    public function primaryKey(): string
    {
        return "usr_id";
    }


    public function getDisplayName(): string
    {
        return $this->fname. ' '. $this->lname;
    }
}