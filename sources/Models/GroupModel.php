<?php

namespace App\Models;

use App\Core\QueryBuilder;

class GroupModel
{
    public static function getAllGroups()
    {
        $queryBuilder = new QueryBuilder();
        return $queryBuilder
            ->select(['*'])
            ->from('groups')
            ->fetchAll();
    }

    public static function getGroupsByUser($user_id)
    {
        $queryBuilder = new QueryBuilder();
        return $queryBuilder
            ->select(['*'])
            ->from('groups')
            ->where('owner_id', $user_id)
            ->fetchAll();
    }

    public static function creatGroupe(int $idUser, string $name): bool
    {
        $queryBuilder = new QueryBuilder();
        return $queryBuilder
            ->insert('groups', ["group_name" => $name, "owner_id" => $idUser])
            ->execute();
    }

    public static function findFriendIntoGroup(int $id_friend, int $id_groupe)
    {
        $queryBuilder = new QueryBuilder();
        return $queryBuilder
            ->select(['*'])
            ->from('groups_keys')
            ->where('id_user', $id_friend)
            ->where('id_groupe', $id_groupe)
            ->fetch();
    }

    public static function linkFriendToGroup(int $id_friend, int $id_groupe): bool
    {
        $queryBuilder = new QueryBuilder();
        return $queryBuilder
            ->insert('groups_keys', ["id_user" => $id_friend, "id_groupe" => $id_groupe])
            ->execute();
    }

    public static function deleteGroup(int $id_user, int $id_groupe): bool
    {
        $queryBuilder = new QueryBuilder();
        return $queryBuilder
            ->delete('groups')
            ->where('id', $id_groupe)
            ->where('owner_id', $id_user)
            ->execute();
    }
}
