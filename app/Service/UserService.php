<?php

namespace axrous\siperpus\Service;

use axrous\siperpus\Config\Database;
use axrous\siperpus\Domain\User;
use axrous\siperpus\Exception\ValidationException;
use axrous\siperpus\Model\UserEditPasswordRequest;
use axrous\siperpus\Model\UserEditPasswordResponse;
use axrous\siperpus\Model\UserLoginRequest;
use axrous\siperpus\Model\UserLoginResponse;
use axrous\siperpus\Model\UserRegisterRequest;
use axrous\siperpus\Model\UserRegisterResponse;
use axrous\siperpus\Repository\UserRepository;
use Exception;

class UserService {

    private UserRepository $userRepository;
    private SessionService $sessionService;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function register(UserRegisterRequest $request): UserRegisterResponse {

        $this->validateUserRegistrationRequest($request);

        try{
            Database::beginTranscation();

            $user = $this->userRepository->findById($request->id);
            if($user != null) {
                throw new ValidationException("User Id already exist");
            }
    
            $user =  new User();
            $user->id = $request->id;
            $user->name = $request->name;
            $user->gender = $request->gender;
            $user->email = $request->email;
            $user->role = "1";
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);
    
            $this->userRepository->save($user);
    
            $response = new UserRegisterResponse();
            $response->user = $user;
    
            Database::commitTranscation();
            return $response;
        } catch(Exception $exception) {
            Database::rollbackTranscation();
            throw $exception;
        }
    }

    public function validateUserRegistrationRequest(UserRegisterRequest $request) {
        if($request->id == null || $request->name == null || $request->gender == null || $request->email == null || $request->password == null || trim($request->id) == '' || trim($request->name) == '' || trim($request->email) == '' || trim($request->password == '')) {
             throw new ValidationException("id, name, email, password cannot blank");
        }

    }

    public function login(UserLoginRequest $request): UserLoginResponse {
        $this->validateUserLoginRequest($request);

        $user = $this->userRepository->findById($request->id);

        if($user == null) {
            throw new ValidationException("Id or Password is wrong");
        }

        if(password_verify($request->password, $user->password)) {
            $response = new UserLoginResponse();
            $response->user = $user;

            return $response;
        } else {
            throw new ValidationException("Id or Password is wrong");
        }
    }

    public function validateUserLoginRequest(UserLoginRequest $request) {
        if($request->id == null || $request->password == null || trim($request->id) == '' || trim($request->password == '')) {
            throw new ValidationException("id, password cannot blank");
       }
    }

    public function showAllUsers() {
        $result = $this->userRepository->findAll();
        return $result;
    }

    public function showSumUsers() {
        $result =$this->userRepository->sumOfUsers();

        return $result;
    }

    public function editPassword(UserEditPasswordRequest $request) {
        // $this->validateEditPasswordRequest($request);

        try{
            Database::beginTranscation();

            $user = $this->userRepository->findById($request->id);
            if($user == null) {
                throw new ValidationException("User not found");
            }

            if(!password_verify($request->oldPassword, $user->password)){
                throw new ValidationException("Old Password is wrong");
            }

            $user->password = password_hash($request->newPassword, PASSWORD_BCRYPT);
            $this->userRepository->update($user);

            Database::commitTranscation();

            $response = new UserEditPasswordResponse();
            $response->user = $user;

            return $response;
        } catch(\Exception $exception){
            Database::rollbackTranscation();
            throw $exception;
        }

    }

    public function validateEditPasswordRequest(UserEditPasswordRequest $request) {
        if($request->password == null || trim($request->password) == '') {
            throw new ValidationException("Password Cannot Blank");
        }
    }
}