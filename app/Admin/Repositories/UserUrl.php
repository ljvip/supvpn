<?php

namespace App\Admin\Repositories;

use App\Models\UserUrl as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class UserUrl extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
