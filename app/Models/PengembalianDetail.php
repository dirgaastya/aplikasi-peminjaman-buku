<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianDetail extends Model
{
    use HasFactory;
    protected $table = 'pengembalian_details';
    protected $primaryKey = 'id';
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'date_return',
        'total_fines',
        'staff_id',
        'member_id',
        'peminjaman_detail_id'
    ];
}
