<?php

namespace App\Services;

use App\Repositories\PublicationRepository;
use App\Repositories\LikeRepository;
use App\Repositories\CommentRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class PublicationService
{
    /**
     * @var publicationRepository
     * @var likeRepository
     * @var commentRepository
     */
    protected $publicationRepository;
    protected $likeRepository;
    protected $commentRepository;


    /**
     *  Construct.
     * @param $publicationRepository
     * @param $likeRepository
     * @param $commentRepository
     * @return void
     */
    public function __construct(
        PublicationRepository $publicationRepository,
        LikeRepository $likeRepository,
        CommentRepository $commentRepository
    )
    {
        $this->publicationRepository = $publicationRepository;
        $this->likeRepository = $likeRepository;
        $this->commentRepository = $commentRepository;
    }

    /*
     * Get all publications but my creation.
     * @return mixed
    */
    public function all(){

        $user_id = Auth::id();

        $publications = $this->publicationRepository->whereNotIn('user_id',[$user_id]);

        return $publications;
    }

    /*
     * Get my publications.
     * @return mixed
    */
    public function my(){

        $user_id = Auth::id();

        $publications = $this->publicationRepository->where(['user_id' => $user_id]);

        return $publications;
    }

    /*
     * find publication from id.
     * @param int $id
     * @return mixed
    */
    public function find(int $id){

        $publication = $this->publicationRepository->find($id);

        return $publication;
    }


    /**
     * Create publication.
     * @param array $data
     * @return mixed
    */
    public function create(array $data){
        $image =   $this->fileUpload($data['image']);
        $title = $data['title'];
        $description = $data['description'];


        $publication = $this->publicationRepository->create([
            'user_id' => Auth::id(),
            'title' => $title,
            'description' => $description,
            'image' => $image,
            ]);

        return $publication;
    }

    /**
     * Update publication.
     * @param array $data
     * @param int $id
     * @return mixed
    */
    public function update(array $data,int $id)
    {
        $publication = $this->publicationRepository->whereOne(['id' => $id, 'user_id' => Auth::id()]);
        if ($publication) {
            $new_data = [
                'title' => $data['title'],
                'description' => $data['description'],
            ];

            if (isset($data['image'])) {
                unlink('image/' . $publication->image);
                $new_data['image']  = $this->fileUpload($data['image']);
            }
            $publication = $this->publicationRepository->update($new_data, ['id' => $id]);

            return $publication;

        }

        return false;
    }


    /**
     * delete publication.
     * @param int $id
     * @return mixed
    */
    public function delete(int $id){
        $publication = $this->publicationRepository->whereOne(['id' => $id,'user_id' => Auth::id()]);
        if ($publication) {
            unlink('image/'.$publication->image);
            $this->publicationRepository->delete(['id' => $publication->id]);
            return true;
        }

        return false;
    }

    /**
     * Upload file.
     *
     * @param object $img
     * @return mixed
     */
    public function fileUpload($img){
        try {

            $name =  $img->getClientOriginalName();
            $unique_name = time() . "_" .$name;
            $img->move(public_path('/image'), $unique_name);

            return $unique_name;

        } catch (Exception $e) {

            return $e->getMessage();
        }
    }
}
