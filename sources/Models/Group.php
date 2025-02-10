<?php

namespace App\Models;

use App\Core\QueryBuilder;

class Group
{
    public static function getAllGroups()
    {
        $queryBuilder = new QueryBuilder();
        return $queryBuilder
            ->select(['*'])
            ->from('groups')
            ->fetchAll();
    }
}
