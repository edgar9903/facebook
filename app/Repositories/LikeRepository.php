<?php

namespace App\Repositories;

use App\Like;

class LikeRepository extends Repository
{
    /**
     * @var $model
     */
    protected $model;
    /**
     *  Construct.
     *
     * @param $like
     * @return void
     */
    public function __construct(like $like)
    {
        $this->model = $like;
    }

}