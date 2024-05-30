<?php

namespace app\models;

use framework\core\Model;

class ContactForm extends Model
{
    public string $name = '';
    public string $email = '';
    public string $tel = '';
    public string $city = '';
    public string $message = '';


    public function labels(): array
    {
        return [
            'name' => 'Your Name',
            'email' => 'Email',
            'tel' => 'Phone',
            'city' => 'City',
            'message' => 'Message'
        ];
    }


    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 3]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'tel' => [self::RULE_REQUIRED],
            'city' => [self::RULE_REQUIRED]
        ];
    }

    public function send(): bool
    {
        return true;
    }
}