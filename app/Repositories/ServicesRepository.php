<?php

namespace App\Repositories;

use App\Interfaces\ServicesRepositoryInterface;
use App\Models\Services;

class ServicesRepository implements ServicesRepositoryInterface
{
    // Property model
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Services $model)
    {
        $this->model = $model;
    }

    // Get all services
    public function index()
    {
        return $this->model->all();
    }

    // Create a new service
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    // Get the service
    public function edit($id)
    {
        return $this->model->find($id);
    }

    // Update a service
    public function update(array $data, $id)
    {
        return $this->model->find($id)->update($data);
    }

    // Delete a service
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
    
}