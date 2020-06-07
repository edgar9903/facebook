<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationAddComment;
use App\Http\Requests\PublicationLikeDislike;
use App\Services\PublicationEventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class PublicationEventController extends Controller
{
    protected $publicationEventService;

    /**
     *  Construct.
     *
     * @param $publicationEventService
     * @return void
     */
    public function __construct(
        PublicationEventService $publicationEventService
    )
    {
        $this->publicationEventService = $publicationEventService;
    }

    /**
     * publication like.
     *
     * @param  \App\Http\Requests\PublicationLikeDislike  $request
     * @return \Illuminate\Http\Response
     */
    public function like(PublicationLikeDislike $request)
    {
        $id = $request->input('id');
        $like = $this->publicationEventService->like($id);
        return Response::json($like);
    }

    /**
     * publication dislike.
     *
     * @param  \App\Http\Requests\PublicationLikeDislike  $request
     * @return \Illuminate\Http\Response
     */
    public function dislike(PublicationLikeDislike $request)
    {
        $id = $request->input('id');
        $dislike = $this->publicationEventService->dislike($id);
        return Response::json($dislike);
    }


    /**
     * publication comment.
     *
     * @param  \App\Http\Requests\PublicationAddComment  $request
     * @return \Illuminate\Http\Response
     */
    public function comment(PublicationAddComment $request)
    {
        $data = $request->only('id','comment');
        $comment = $this->publicationEventService->comment($data);
        return Response::json($comment);
    }

}
