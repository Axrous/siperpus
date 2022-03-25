<?php

namespace axrous\siperpus\Controller;

use axrous\siperpus\App\View;
use axrous\siperpus\Config\Database;
use axrous\siperpus\Repository\SessionRepository;
use axrous\siperpus\Repository\UserRepository;
use axrous\siperpus\Service\SessionService;

class HomeController {

    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();

        $userRepository = new UserRepository($connection);
        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }
    
    public function index(){

        $user = $this->sessionService->current();

        if($user == null) {
            View::render('Home/index', [
                "title" => "SIPERPUS"
            ]);
        } else {
            if($user->role == "1") {
                View::render('Home/dashboard', [
                    "title" => "Dashboard",
                    "user" => [
                        "name" => $user->name
                    ]
                ]);
            }
            if($user->role == "2") {
                View::render('Home/Admin/dashboard', [
                    "title" => "SIPERPUS"
                ]);
            }
           
            }
        }

    
}