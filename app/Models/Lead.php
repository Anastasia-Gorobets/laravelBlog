<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable=['name'];

    /**
     * Get the notes for the lead.
     */
    public function notes()
    {
        return $this->hasMany(Note::class);
    }


}
