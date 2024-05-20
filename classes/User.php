<?php

namespace Overload;

use Exception;
use Overload\MyException as MyException;

class User
{
    private string $name;
    private int $age;
    private string $email;

    public function __construct($name, $age, $email)
    {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getAll()
    {
        return [
            'name' => $this->name,
            'age' => $this->age,
            'email' => $this->email
        ];
    }

    public function __call(string $name, array $arguments)
    {
        if (!method_exists($this, $name)) {
            throw new MyException("Method <b>$name</b> does not exist");
        }else {
            return call_user_func_array([$this, $name], $arguments);
        }
    }
}