<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

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

    /**
     * get likes from publication_id.
     *
     * @return mixed
     */
    public function getLikes()
    {
        return $this->hasMany(Like::class,'publication_id');
    }

    /**
     * get my like from publication_id and user_id.
     *
     * @return mixed
     */
    public function getMyLike()
    {
        $id = Auth::id();
        return $this->belongsTo(Like::class,'id','publication_id')
            ->where('user_id',$id);
    }

    /**
     * get dislikes from publication_id.
     *
     * @return mixed
     */
    public function getDislikes()
    {
        return $this->hasMany(Dislike::class,'publication_id');
    }

    /**
     * get my dislike from publication_id and user_id.
     *
     * @return mixed
     */
    public function getMyDislike()
    {
        $id = Auth::id();
        return $this->belongsTo(Dislike::class,'id','publication_id')
            ->where('user_id',$id);
    }


    /**
     * get comments from publication_id.
     *
     * @return mixed
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class,'publication_id');
    }

}
