<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon; 
use \DateTimeInterface;

class Pemasukan extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'pemasukan';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nominal',
        'keterangan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_pemasukan');
    }
}
