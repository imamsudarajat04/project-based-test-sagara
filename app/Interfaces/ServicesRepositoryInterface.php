<?php

namespace App\Interfaces;

interface ServicesRepositoryInterface
{
    public function index();
    public function store(array $data);
    public function edit($id);
    public function update(array $data, $id);
    public function delete($id);
}