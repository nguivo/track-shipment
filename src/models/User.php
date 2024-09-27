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

    public string $usr_fname = '';
    public string $usr_lname = '';
    public string $cmny = '';
    public int $status = self::STATUS_INACTIVE;
    public string $usr_email = '';
    public string $usr_pass = '';
    public string $rpass = '';


    public function rules(): array
    {
        return[
            'usr_fname' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3], [self::RULE_MAX, 'max' => 30]],
            'usr_lname' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 30]],
            'usr_email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'usr_pass' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 6]],
            'rpass' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'usr_pass']],
        ];
    }


    public function labels(): array
    {
        return [
            'usr_fname' => 'First Name',
            'usr_lname' => 'Last Name',
            'cmny' => 'Company',
            'usr_email' => 'Email',
            'usr_pass' => 'Password',
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