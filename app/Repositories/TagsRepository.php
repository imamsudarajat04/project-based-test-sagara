<?php

namespace App\Repositories;

use App\Interfaces\TagsRepositoryInterface;
use App\Models\Tags;

class TagsRepository implements TagsRepositoryInterface
{
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Tags $model)
    {
        $this->model = $model;
    }

    // Get all tags
    public function index()
    {
        return $this->model->all();
    }

    // Create a new tag
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    // Get the tag
    public function edit($id)
    {
        return $this->model->find($id);
    }

    // Update a tag
    public function update(array $data, $id)
    {
        return $this->model->find($id)->update($data);
    }

    // Delete a tag
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
}