<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Publication extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image'
    ];

    /**
     * get user from user_id.
     *
     * @return mixed
     */
    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
