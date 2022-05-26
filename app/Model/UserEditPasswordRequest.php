<?php

namespace axrous\siperpus\Model;

class UserEditPasswordRequest {
    public ?string $id = null;
    public ?string $newPassword = null;
    public ?string $oldPassword = null;
}