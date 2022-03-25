<?php

namespace axrous\siperpus\Repository;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Domain\Sessions;
use axrous\siperpus\Domain\User;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertNull;

class SessionRepositoryTest extends TestCase{

    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;


    protected function setUp():void
    {
       $this->userRepository = new UserRepository(Database::getConnection());
       $this->sessionRepository = new SessionRepository(Database::getConnection());

       $this->sessionRepository->deleteAll();
       $this->userRepository->deleteAll();

       $user = new User();
       $user->id = 'arga';
       $user->email = 'argsatya16@gmail.com';
       $user->gender = 'Pria';
       $user->name = 'Arga Satya M';
       $user->password = 'rahasia';
       $user->role = '2';

       $this->userRepository->save($user);
    }

    public function testSaveSuccess() {
        $session = new Sessions();
        $session->id = uniqid();
        $session->userId = "arga";

        $this->sessionRepository->save($session);

        $result = $this->sessionRepository->findById($session->id);
        

        $this->assertEquals($session->id, $result->id);
        $this->assertEquals($session->userId, $result->userId);
    }
    
    public function testFindByIdNotFound() {


        $result = $this->sessionRepository->findById("coba");

        $this->assertNull($result);
    }

    public function testDeleteByIdSuccess() {
        $session = new Sessions();
        $session->id = uniqid();
        $session->userId = "arga";

        $this->sessionRepository->save($session);

        $result = $this->sessionRepository->findById($session->id);
        $this->assertEquals($session->id, $result->id);
        $this->assertEquals($session->userId, $result->userId);

        $result = $this->sessionRepository->deleteById($session->id);

        $this->assertNull($result);


    }
    
}