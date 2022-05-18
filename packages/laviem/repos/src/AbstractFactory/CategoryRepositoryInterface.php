<?php

namespace LaviemRepos\AbstractFactory;

interface CategoryRepositoryInterface
{
    function getCategory($idCategory, $idUser);

    function getCategories($idUser);

    function getCategoriesByName($idUser);

    function store($data, $idUser);

    function update($data, $idCategory, $idUser);

    function delete($idCategory, $idUser);
}
