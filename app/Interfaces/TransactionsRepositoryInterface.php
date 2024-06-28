<?php

namespace App\Interfaces;

interface TransactionsRepositoryInterface
{
    public function index();
    public function store(array $data);
    public function edit($id);
    public function update(array $data, $id);
    public function destroy($id);
}