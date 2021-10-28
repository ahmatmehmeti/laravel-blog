<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    public function find($id, $relations = [])
    {
        return $this->model->with($relations)->find($id);
    }

    public function get()
    {
        return $this->model->all();
    }
}
