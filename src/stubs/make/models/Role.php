<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

      protected $fillable = ['name', 'description'];

      protected $table = 'roles';

      public function users()
      {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id');
      }
}
