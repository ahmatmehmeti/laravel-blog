<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository extends BaseRepository
{

    public function getModel()
    {
        return new Tag();
    }

    public function getTags()
    {
        return $this->get();
    }

    public function createTag(array $data)
    {
        return $this->model->create([
            'name' => $data['name']
        ]);
    }

    public function findTag($id)
    {
        return $this->find($id);
    }

    public function updateTag($id ,array $data)
    {
        $tag=$this->findTag($id);
        $tag->update($data);
    }

    public function deleteTag($id)
    {
        $tag = $this->findTag($id);
        $tag->delete();
    }

}
