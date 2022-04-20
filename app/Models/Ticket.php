<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'tickets';

    protected $fillable = [
        'user_id',
        'mobile',
        'assets',
        'priority',
        'serial_number',
        'model_number',
        'status',
        'agent_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function agent(){
        return $this->belongsTo(User::class,'agent_id','id');
    }
}
