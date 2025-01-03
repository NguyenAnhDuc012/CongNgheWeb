<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = ['computer_id', 'reported_by', 'reported_date', 'description', 'urgency', 'status'];

    public function computer_hello()
    {
        return $this->belongsTo(Computer::class, 'computer_id', 'id');
    }
}
