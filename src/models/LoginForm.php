<?php

namespace app\models;

use framework\core\Application;
use framework\core\db\DbModel;

class LoginForm extends DbModel
{
    public string $email = '';
    public string $pass = '';

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['email', 'pass'];
    }

    public function labels(): array
    {
        return [
            'email' => 'Email',
            'pass' => 'Password'
        ];
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'pass' => [self::RULE_REQUIRED]
        ];
    }

    public function login()
    {
        //implement login logic
        $user = $this->findOne(['email' => $this->email]);
        if(!$user) {
            $this->addError('email', 'User with this email doesn\'t exist');
            return false;
        }
        if(!password_verify($this->pass, $user->pass)) {
            $this->addError('pass', 'Login credentials incorrect');
            return false;
        }
        return Application::$app->login($user);
    }

    public function primaryKey(): string
    {
        return "usr_id";
    }
}