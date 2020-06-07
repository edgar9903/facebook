<?php

namespace App\Services;

use App\Repositories\UserRepository;


class UserService
{
    /**
     * @var userRepository

     */
    protected $userRepository;


    /**
     *  Construct.
     *
     * @param $UserRepository
     * @return void
     */
    public function __construct(
        UserRepository $UserRepository
    )
    {
        $this->userRepository = $UserRepository;
    }
}
