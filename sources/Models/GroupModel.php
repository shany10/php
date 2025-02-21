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

    public static function creatGroupe(int $idUser, string $name): int
    {
        $queryBuilder = new QueryBuilder();
        return $queryBuilder
            ->insert('groups', ["group_name" => $name, "owner_id" => $idUser])
            ->executeAndGetId();
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

    public static function linkFriendToGroup(int $id_user, int $id_groupe): bool
    {
        $queryBuilder = new QueryBuilder();
        return $queryBuilder
            ->insert('groups_keys', ["id_user" => $id_user, "id_groupe" => $id_groupe])
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
    
    public static function getAllGroupeLinked(int $id_user)
    {
        $queryBuilder = new QueryBuilder();
        return $queryBuilder
            ->select(['*'])
            ->from('groups_keys')
            ->join('groups', 'groups_keys.id_groupe', 'groups.id')
            ->where('id_user', $id_user)
            ->fetchAll();
    }
}
