<?php

namespace App\Interfaces;

interface TagsRepositoryInterface
{
    public function index();
    public function store(array $data);
    public function edit($id);
    public function update(array $data, $id);
    public function delete($id);
}