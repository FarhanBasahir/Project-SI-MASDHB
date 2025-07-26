<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JawabanTugas extends Model
{
    use HasFactory;
    protected $guarded = [];

    // TAMBAHKAN METHOD-METHOD INI
    public function tugas(): BelongsTo
    {
        return $this->belongsTo(Tugas::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
