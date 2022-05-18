<?php

namespace LaviemRepos\AbstractFactory;

interface UserRepositoryInterface
{
    public function getUsers();

    public function getUser($idUser);

    public function getUsersPagination();

    public function store($data);

    public function update($data, $idUser);

    public function delete($idUser);
}
