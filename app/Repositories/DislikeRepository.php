<?php

namespace App\Repositories;

use App\Dislike;

class DislikeRepository extends Repository
{
    /**
     * @var $model
     */
    protected $model;
    /**
     *  Construct.
     *
     * @param $dislike
     * @return void
     */
    public function __construct(Dislike $dislike)
    {
        $this->model = $dislike;
    }

}