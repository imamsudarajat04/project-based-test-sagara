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
        $tags = $data['tags'] ?? []; // Get tags from data
        unset($data['tags']); // Remove tags from data

        // Create the product
        $product = $this->model->create($data);

        // Attach tags to the product
        $product->tags()->attach($tags);

        return $product;
    }

    // Get the product
    public function edit($id)
    {
        return $this->model->find($id);
    }

    // Update a product
    public function update(array $data, $id)
    {
        // find the product
        $product = $this->model->findOrFail($id);

        $tags = $data['tags'] ?? []; // Get tags from data
        unset($data['tags']); // Remove tags from data

        // Update the product
        $product->update($data);

        // Sync tags to the product
        $product->tags()->sync($tags);

        return $product;
    }

    // Delete a product
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }
    
}
