<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'publication_id',
        'comment'
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
