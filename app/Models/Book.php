<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'published_year',
        'authors',
        'categories',
    ];

    // Para PostgreSQL: convertir JSON automáticamente
    protected $casts = [
        'authors' => 'array',           // Convierte JSON a array en PHP
        'categories' => 'array',        // Convierte JSON a array en PHP
        'published_year' => 'integer',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

