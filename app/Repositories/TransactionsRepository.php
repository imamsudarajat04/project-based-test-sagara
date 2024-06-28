<?php

namespace App\Repositories;

use App\Interfaces\TransactionsRepositoryInterface;
use App\Models\Transactions;

class TransactionsRepository implements TransactionsRepositoryInterface
{
    // Property model
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Transactions $model)
    {
        $this->model = $model;
    }

    // Get all transactions
    public function index()
    {
        return $this->model->with('products', 'services', 'users')->get();
    }

    // Create a new transaction
    public function store(array $data)
    {
        // Create the transaction
        return $this->model->create($data);
    }

    // Get the transaction
    public function edit($id)
    {
        return $this->model->find($id);
    }

    // Update a transaction
    public function update(array $data, $id)
    {
        // find the transaction
        $transaction = $this->model->find($id);

        return $transaction->update($data);
    }

    // Delete a transaction
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }
}