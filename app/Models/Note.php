<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    /**
     * Get the lead that owns the note.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
