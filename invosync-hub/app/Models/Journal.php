<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }
}
