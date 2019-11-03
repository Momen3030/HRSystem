<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'annual', 'monthly', 'free','expired'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
