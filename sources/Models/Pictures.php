<?php

namespace App\Models;

use App\Core\QueryBuilder;

class Pictures
{

    public static function uploadPicture($userId, $group_id, $filePath)
    {
        $queryBuilder = new QueryBuilder();

        return $queryBuilder
            ->insert('pictures', [
                'user_id' => $userId,
                'group_id' => $group_id,
                'file_path' => $filePath
            ])
            ->executeAndGetId();
    }

    public static function getPictureById($pictureId)
    {
        $queryBuilder = new QueryBuilder();

        return $queryBuilder
            ->select(['*'])
            ->from('pictures')
            ->where('id', $pictureId)
            ->fetch();
    }

    public static function getAllPictures($userId, $uploaded_at, $filePath)
    {
        $queryBuilder = new QueryBuilder();

        return $queryBuilder
            ->select([
                'id' => $userId,
                'file_path' => $filePath,
                'uploaded_at' => $uploaded_at
            ])
            ->from('pictures')
            ->orderBy('uploaded_at', 'DESC')
            ->fetchAll();
    }

    public static function deletePicture($pictureId, $userId, $group_id, $isOwner)
    {
        $queryBuilder = new QueryBuilder();

        if ($isOwner) {
            return $queryBuilder
                ->delete('pictures')
                ->where('user_id', $userId)
                ->execute();
        } else {
            return $queryBuilder
                ->delete('pictures')
                ->where('id', $pictureId)
                ->where('user_id', $userId)
                ->where('group_id', $group_id)
                ->execute();
        }
    }

    public static function getPicturesByGroup($groupId)
    {
        $queryBuilder = new QueryBuilder();

        return $queryBuilder
            ->select(['*'])
            ->from('pictures')
            ->where('group_id', $groupId)
            ->fetchAll();
    }

}
