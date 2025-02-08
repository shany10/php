<?php

namespace App\Models;

use App\Core\QueryBuilder;

class Pictures
{

    public static function save($userId, $fileName, $filePath)
    {
        $queryBuilder = new QueryBuilder();

        return $queryBuilder
            ->insert('pictures', [
                'user_id' => $userId,
                'file_name' => $fileName,
                'file_path' => $filePath
            ])
            ->executeAndGetId();
    }
    public static function getAll()
    {
        $queryBuilder = new QueryBuilder();

        return $queryBuilder
            ->select(['id', 'file_name', 'file_path'])
            ->from('pictures')
            ->execute();
    }

    public static function delete($pictureId)
    {
        $queryBuilder = new QueryBuilder();

        return $queryBuilder
            ->delete('pictures')
            ->where('id', $pictureId)
            ->execute();
    }

    public static function getOneById($pictureId)
    {
        $queryBuilder = new QueryBuilder();

        return $queryBuilder
            ->select(['id', 'file_name', 'file_path'])
            ->from('pictures')
            ->where('id', $pictureId)
            ->fetch();
    }
}
