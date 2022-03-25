<?php

namespace axrous\siperpus\App{
    function header(string $value) {
        echo $value;
    }
}

namespace axrous\siperpus\Controller {

    use axrous\siperpus\Config\Database;
    use axrous\siperpus\Repository\UserRepository;
    use axrous\siperpus\Controller\UserController;
    use axrous\siperpus\Domain\User;
    use PHPUnit\Framework\TestCase;

    class UserControllerTest extends TestCase {

        private UserController $userController;
        private UserRepository $userRepository;

        protected function setUp(): void
        {
            $this->userController = new UserController();

            $this->userRepository = new UserRepository(Database::getConnection());
            $this->userRepository->deleteAll();

            putenv("mode=test");
        }

        public function testRegister() {

            $this->userController->register();

            $this->expectOutputRegex('[Register]');
            $this->expectOutputRegex('[ID]');
            $this->expectOutputRegex('[Name]');
            $this->expectOutputRegex('[Gender]');
        }

        public function testPostRegisterSuccess() {
            $_POST['id'] = "arga";
            $_POST['name'] = "Arga";
            $_POST['gender'] = "Pria";
            $_POST['email'] = "argasatya16@gmail.com";
            $_POST['password'] = "rahasia";

            $this->userController->postRegister();

            $this->expectOutputRegex("[/users/login]");
        }

        public function testPostRegisterFailed() {
            $_POST['id'] = "";
            $_POST['name'] = "Arga";
            $_POST['gender'] = "Pria";
            $_POST['email'] = "argasatya16@gmail.com";
            $_POST['password'] = "rahasia";

            $this->userController->postRegister();

            $this->expectOutputRegex('[Register]');
            $this->expectOutputRegex('[ID]');
            $this->expectOutputRegex('[Name]');
            $this->expectOutputRegex('[Gender]');
            $this->expectOutputRegex('[id, name, email, password cannot blank]');
        }

        public function testPostRegisterDuplicate() {

            $user = new User();
            $user->id = "arga";
            $user->name = "Arga";
            $user->gender = "Pria";
            $user->email = "argasatya16@gmail.com";
            $user->password = "rahasia";
            $user->role = "1";

            $this->userRepository->save($user);

            $_POST['id'] = "arga";
            $_POST['name'] = "Arga";
            $_POST['gender'] = "Pria";
            $_POST['email'] = "argasatya16@gmail.com";
            $_POST['password'] = "rahasia";

            $this->userController->postRegister();

            
            $this->expectOutputRegex('[Register]');
            $this->expectOutputRegex('[ID]');
            $this->expectOutputRegex('[Name]');
            $this->expectOutputRegex('[Gender]');
            $this->expectOutputRegex('[User Id already exist]');

        }

        public function testLogin() {
            $this->userController->login();

            $this->expectOutputRegex('[Login]');
            $this->expectOutputRegex('[Sign In]');
            $this->expectOutputRegex('[Welcome Back]');
            $this->expectOutputRegex('[Siperpus paling perpus]');
        }
    }
}