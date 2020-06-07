<?php

namespace App\Repositories;

use App\Comment;

class CommentRepository extends Repository
{
    /**
     * @var $model
     */
    protected $model;
    /**
     *  Construct.
     *
     * @param $comment
     * @return void
     */
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

}