<?php

namespace App\Admin\Repositories;

use App\Models\UserCc as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class UserCc extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
