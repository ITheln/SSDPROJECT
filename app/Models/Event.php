<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',          // <--- ADD THIS LINE!
        'title',
        'description',
        'event_date',
        'max_capacity',
        'location',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    // Relationship: Users who registered for this event
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}