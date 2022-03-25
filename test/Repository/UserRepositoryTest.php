<?php

namespace axrous\siperpus\Repository;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Domain\User;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase {


    private UserRepository $userRepository;

    protected function setUp():void {

        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userRepository->deleteAll();
    }

    public function testSaveSuccess() {
        
        $user = new User();
        $user->id = 'arga';
        $user->email = 'argsatya16@gmail.com';
        $user->gender = 'Pria';
        $user->name = 'Arga Satya M';
        $user->password = 'rahasia';
        $user->role = '2';

        $this->userRepository->save($user);

        $result = $this->userRepository->findById($user->id);

        $this->assertEquals($result->id, $user->id);
    }

    public function testFindByIdNotFound() {
        $user = $this->userRepository->findById("notfound");

        $this->assertNull($user);
    }

}