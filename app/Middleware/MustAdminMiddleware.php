<?php 

namespace axrous\siperpus\Middleware;

use axrous\siperpus\App\View;
use axrous\siperpus\Config\Database;
use axrous\siperpus\Repository\SessionRepository;
use axrous\siperpus\Repository\UserRepository;
use axrous\siperpus\Service\SessionService;

class MustAdminMiddleware implements Middleware {

    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    function before():void {
        $user = $this->sessionService->current();

        if($user->role != "2") {
            View::redirect('/');
        }
    }
}