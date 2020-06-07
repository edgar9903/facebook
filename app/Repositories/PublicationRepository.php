<?php

namespace App\Repositories;

use App\Publication;

class PublicationRepository extends Repository
{
    /**
     * @var $model
     */
    protected $model;
    /**
     *  Construct.
     *
     * @param $publication
     * @return void
     */
    public function __construct(Publication $publication)
    {
        $this->model = $publication;
    }

}