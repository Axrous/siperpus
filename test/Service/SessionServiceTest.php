<?php

namespace axrous\siperpus\Service;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Domain\Sessions;
use axrous\siperpus\Repository\SessionRepository;
use axrous\siperpus\Repository\UserRepository;
use PHPUnit\Framework\TestCase;
use axrous\siperpus\Domain\User;


function setcookie(string $name, string $value){
    echo "$name: $value";
}

class SessionServiceTest extends TestCase {

    private UserRepository $userRepository;
    private SessionRepository $sessionRepository;
    private SessionService $SessionService;

    protected function setUp():void
    {
       $this->userRepository = new UserRepository(Database::getConnection());
       $this->sessionRepository = new SessionRepository(Database::getConnection());
       $this->SessionService = new SessionService($this->sessionRepository, $this->userRepository);


       $this->sessionRepository->deleteAll();
       $this->userRepository->deleteAll();

       $user = new User();
       $user->id = "arga";
       $user->name = "Arga";
       $user->gender = "Pria";
       $user->email = "argasatya16@gmail.com";
       $user->password = "rahasia";
       $user->role = "1";
       $this->userRepository->save($user);
    }

    public function testCreate() {
        $session = $this->SessionService->create("arga");

        $this->expectOutputRegex("[SIPERPUS_SESSION: $session->id]");

        $result = $this->sessionRepository->findById($session->id);
        
        $this->assertEquals("arga", $result->userId);
    }

    public function testDestroy() {
        $session = new Sessions();
        $session->id = uniqid();
        $session->userId = "arga";

        $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

        $this->SessionService->destroy();

        $this->expectOutputRegex("[SIPERPUS_SESSION: ]");

        $result = $this->sessionRepository->findById($session->id);
        $this->assertNull($result);
    }

    public function testCurrent() {
        $session = new Sessions();
        $session->id = uniqid();
        $session->userId = "arga";

        $this->sessionRepository->save($session);

        $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

        $user = $this->SessionService->current();
        $result = $this->SessionService->current();

        $this->assertEquals($session->userId, $user->id);
    }
    
}