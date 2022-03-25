<?php

namespace axrous\siperpus\Model;

class UserRegisterRequest {
    public ?string $id = null;
    public ?string $name = null;
    public ?string $gender = null;
    public ?string $email =null;
    public ?string $password = null;
    public ?string $role = null;
}