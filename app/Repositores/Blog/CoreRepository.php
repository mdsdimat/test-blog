<?php


namespace App\Repositores\Blog;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Eloquent;

abstract class CoreRepository
{
    /**
     * @var Eloquent
     */
    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return Model|Application|mixed
     */
    protected function startCondition()
    {
        return clone $this->model;
    }
}
