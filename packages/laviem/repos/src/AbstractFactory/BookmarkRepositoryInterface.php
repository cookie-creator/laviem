<?php

namespace LaviemRepos\AbstractFactory;

interface BookmarkRepositoryInterface
{
    function getBookmark($idBookmark, $idUser);

    function getBookmarks($idUser);

    function getBookmarksPagination($idUser);

    function store($data, $idUser);

    function update($data, $idBookmark, $idUser);

    function delete($idBookmark, $idUser);
}
