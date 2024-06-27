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
        return $this->model->with('tags')->get();
    }

    // Create a new service
    public function store(array $data)
    {
        $tags = $data['tags'] ?? []; // Get tags from data
        unset($data['tags']); // Remove tags from data

        // Create the service
        $service = $this->model->create($data);

        // Attach tags to the service
        $service->tags()->attach($tags);

        return $service;
    }

    // Get the service
    public function edit($id)
    {
        return $this->model->find($id);
    }

    // Update a service
    public function update(array $data, $id)
    {
        $service = $this->model->findOrFail($id);

        $tags = $data['tags'] ?? []; // Get tags from data
        unset($data['tags']); // Remove tags from data

        // Update the service
        $service->update($data);

        // Sync tags to the service
        $service->tags()->sync($tags);

        return $service;
    }

    // Delete a service
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
    
}