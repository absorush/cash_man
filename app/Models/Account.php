<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model {
    use HasFactory;
    protected $fillable = ['name', 'type'];

    // An account can have multiple journal entries
    public function journalEntries() {
        return $this->hasMany(JournalEntry::class);
    }
}
