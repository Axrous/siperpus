<?php

namespace axrous\siperpus\Service;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Exception\ValidationException;
use axrous\siperpus\Model\UserRegisterRequest;
use axrous\siperpus\Repository\UserRepository;
use axrous\siperpus\Domain\User;
use axrous\siperpus\Model\UserLoginRequest;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase{


    private UserService $userService;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $connection = Database::getConnection();
        $this->userRepository = new UserRepository($connection);
        $this->userService = new UserService($this->userRepository);
        $this->userRepository->deleteAll();
        
    }

    public function testRegisterSuccess(){

        $request = new UserRegisterRequest();
        $request->id = "arga";
        $request->name = "Arga";
        $request->gender = "Pria";
        $request->email = "argasatya16@gmail.com";
        $request->password = "rahasia";

        $response = $this->userService->register($request);


        self::assertEquals($request->id, $response->user->id);
        self::assertEquals($request->name, $response->user->name);
        self::assertEquals("1", $response->user->role);
        self::assertNotEquals($request->password, $response->user->password);
        self::assertTrue(password_verify($request->password, $response->user->password));
    }

    public function testRegisterFailed(){

        self::expectException(ValidationException::class);

        $request = new UserRegisterRequest();
        $request->id = "";
        $request->name = "Arga";
        $request->gender = "Pria";
        $request->email = "argasatya16@gmail.com";
        $request->password = "rahasia";

        $this->userService->register($request);


    }

    public function testRegisterDuplicate(){

        $user = new User();
        $user->id = "arga";
        $user->name = "Arga";
        $user->gender = "Pria";
        $user->email = "argasatya16@gmail.com";
        $user->password = "rahasia";
        $user->role = "1";
        $this->userRepository->save($user);


        self::expectException(ValidationException::class);


        $request = new UserRegisterRequest();
        $request->id = "arga";
        $request->name = "Arga";
        $request->gender = "Pria";
        $request->email = "argasatya16@gmail.com";
        $request->password = "rahasia";
        $this->userService->register($request);


    }

    public function testLoginSuccess() {

        $user = new User();
        $user->id = "arga";
        $user->name = "Arga";
        $user->gender = "Pria";
        $user->email = "argasatya16@gmail.com";
        $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
        $user->role = "1";

        $this->expectException(ValidationException::class);

        $request = new UserLoginRequest();
        $request->id = "arga";
        $request->password = "rahasia";

        $response = $this->userService->login($request);

        $this->assertEquals($request->id, $response->user->id);
        $this->assertTrue(password_verify($request->password, $response->user->password));

    }

    public function testLoginNotFound() {
        $user = new User();
        $user->id = "arga";
        $user->name = "Arga";
        $user->gender = "Pria";
        $user->email = "argasatya16@gmail.com";
        $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
        $user->role = "1";

        $this->expectException(ValidationException::class);

        $request = new UserLoginRequest();
        $request->id = "eko";
        $request->password = "rahasia";

        $this->userService->login($request);
    }

    public function testLoginWrongPass() {
        $user = new User();
        $user->id = "arga";
        $user->name = "Arga";
        $user->gender = "Pria";
        $user->email = "argasatya16@gmail.com";
        $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
        $user->role = "1";
        
        $this->expectException(ValidationException::class);

        $request = new UserLoginRequest();
        $request->id = "arga";
        $request->password = "arga";

        $this->userService->login($request);
    }
}