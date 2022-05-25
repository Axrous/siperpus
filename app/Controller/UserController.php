<?php

namespace axrous\siperpus\Controller;

use axrous\siperpus\App\View;
use axrous\siperpus\Config\Database;
use axrous\siperpus\Exception\ValidationException;
use axrous\siperpus\Model\UserLoginRequest;
use axrous\siperpus\Model\UserRegisterRequest;
use axrous\siperpus\Repository\SessionRepository;
use axrous\siperpus\Repository\UserRepository;
use axrous\siperpus\Service\SessionService;
use axrous\siperpus\Service\UserService;

class UserController {

    
    private UserService $userService;
    private SessionService $sessionService;
    

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);

        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }


    public function register(){
        View::render('User/register',[
            "title" => "Register"
        ]);
    }

    public function postRegister() {
        $request = new UserRegisterRequest();
        $request->id = $_POST["id"];
        $request->name = $_POST["name"];
        $request->gender = $_POST["gender"];
        $request->email = $_POST["email"];
        $request->password = $_POST["password"];

        try{
            $this->userService->register($request);
            View::redirect('/users/login');
        } catch(ValidationException $exception) {
            View::render('User/register',[
                "title" => "Register",
                "error" => $exception->getMessage()
            ]);
        }
    }

    public function login() {
        View::render('User/login', [
            "title" => "Login User"
        ]);
    }

    public function postLogin() {

        $request = new UserLoginRequest();
        $request->id = $_POST['id'];
        $request->password = $_POST['password'];

        try{
            $response= $this->userService->login($request);
            $this->sessionService->create($response->user->id);
            View::redirect('/');
        } catch (ValidationException $exception) {
            View::render('User/login',[
                "title" => "Login User",
                "error" => $exception->getMessage()
            ]);
        }
    }

    public function logout() {
        $this->sessionService->destroy();
        View::redirect('/');
    }

    public function users() {

        $user = $this->userService->showAllUsers();

        View::render("Home/Admin/users", [
            "title" => "Anggota Perpus",
            "user" => $user
        ]);
    }

    public function userProfile(){
        $user = $this->sessionService->current();
        
        View::render("User/profile", [
            'title' => "Profile",
            'user' => [
                'nama' => $user->name,
                'gender' => $user->gender,
                'email' => $user->email
            ]
        ]);
    }

    public function profileEdit() {
        $user = $this->sessionService->current();
        
        View::render("User/profile-edit", [
            'title' => "Edit Profile",
        ]);
    }
    

}