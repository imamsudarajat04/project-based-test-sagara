<?php

namespace App\Repositories;

use App\Models\Products;
use App\Interfaces\ProductsRepositoryInterface;

class ProductsRepository implements ProductsRepositoryInterface
{
    // Property model
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Products $model)
    {
        $this->model = $model;
    }

    // Get all products
    public function index()
    {
        return $this->model->with('tags')->get();
    }

    // Create a new product
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    // Get the product
    public function edit($id)
    {
        return $this->model->find($id);
    }

    // Update a product
    public function update(array $data, $id)
    {
        return $this->model->find($id)->update($data);
    }

    // Delete a product
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
    
}
