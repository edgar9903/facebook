<?php

namespace App\Services;

use App\Repositories\PublicationRepository;
use App\Repositories\LikeRepository;
use App\Repositories\DislikeRepository;
use App\Repositories\CommentRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class PublicationEventService
{
    /**
     * @var publicationRepository
     * @var likeRepository
     * @var dislikeRepository
     * @var commentRepository
     * @var userRepository
     */
    protected $publicationRepository;
    protected $likeRepository;
    protected $dislikeRepository;
    protected $commentRepository;
    protected $userRepository;


    /**
     *  Construct.
     * @param $publicationRepository
     * @param $likeRepository
     * @param $commentRepository
     * @param $dislikeRepository
     * @return void
     */
    public function __construct(
        PublicationRepository $publicationRepository,
        LikeRepository $likeRepository,
        CommentRepository $commentRepository,
        DislikeRepository $dislikeRepository,
        UserRepository $userRepository
    )
    {
        $this->publicationRepository = $publicationRepository;
        $this->likeRepository = $likeRepository;
        $this->commentRepository = $commentRepository;
        $this->dislikeRepository = $dislikeRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * like publication.
     * @param string $id
     * @return mixed
    */
    public function like(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
            $data = ['publication_id' => $id, 'user_id' => Auth::id()];
            $publication = $this->likeRepository->whereOne($data);
            if (!$publication) {
                $this->dislikeRepository->delete($data);
                $this->likeRepository->create($data);
               $count = $this->dislikeRepository->where(['publication_id' => $id]);
                return [
                    'status' => true,
                    'message' => 'success',
                    'dislike_count' => $count->count()
                ];
            } else {
                $this->likeRepository->delete($data);
              $count = $this->dislikeRepository->where(['publication_id' => $id]);
                return [
                    'status' => false,
                    'message' => 'delete',
                    'dislike_count' => $count->count()
                ];
            }

        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * dislike publication.
     * @param string $id
     * @return mixed
     */
    public function dislike(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
            $data = ['publication_id' => $id, 'user_id' => Auth::id()];
            $publication = $this->dislikeRepository->whereOne($data);
            if (!$publication) {
                $this->likeRepository->delete($data);
                $this->dislikeRepository->create($data);
                $count = $this->likeRepository->where(['publication_id' => $id]);
                return [
                    'status' => true,
                    'message' => 'success',
                    'like_count' => $count->count()
                ];
            } else{
                $this->dislikeRepository->delete($data);
                $count = $this->likeRepository->where(['publication_id' => $id]);
                return [
                    'status' => false,
                    'message' => 'delete',
                    'like_count' => $count->count()
                ];
            }
        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * comment publication.
     * @param array $data
     * @return mixed
     */
    public function comment(array $data)
    {
        try {
            $id = Crypt::decrypt($data['id']);

            $data = ['publication_id' => $id, 'user_id' => Auth::id(),'comment' => $data['comment']];
            $comment = $this->commentRepository->create($data);
            $user = $this->userRepository->find(Auth::id());
            return [
                'status' => true,
                'message' => 'success',
                'comment' => $data['comment'],
                'name' => $user->name,
                'time' => Carbon::parse($comment->created_at)->format('H:i')
            ];

        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
