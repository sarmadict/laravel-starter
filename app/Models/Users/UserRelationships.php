<?php

namespace App\Models\Users;


trait UserRelationships
{
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id', 'creator');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id', 'approver');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id', 'approver');
    }

}