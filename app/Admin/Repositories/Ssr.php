<?php

namespace App\Admin\Repositories;

use App\Models\Ssr as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Ssr extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
