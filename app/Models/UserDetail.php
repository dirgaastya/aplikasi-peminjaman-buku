<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userDetails extends Model
{
    use HasFactory;
    protected $table = 'users_details';
    protected $primaryKey = 'id';
    public $incrementing = false;
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'gender',
        'address',
        'telp',
        'user_id'
    ];
}
