<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationUpdate;
use App\Http\Requests\PublicationCreate;
use App\Services\PublicationService;
use App\Services\UserService;
use Illuminate\Support\Facades\Redirect;

class PublicationController extends Controller
{

    protected $publicationService;
    protected $userService;

    /**
     *  Construct.
     *
     * @param $publicationService
     * @param $userService
     * @return void
     */
    public function __construct(
        PublicationService $publicationService,
        UserService $userService
    )
    {
        $this->publicationService = $publicationService;
        $this->userService = $userService;
    }

    /**
     * Get all publications but my creation.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $publications = $this->publicationService->all();

        return view('publications.index',compact('publications'));
    }

    /**
     * Show the form for creating a new publication.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publications.create');
    }

    /**
     * Store a newly created publication in database.
     *
     * @param  \App\Http\Requests\PublicationCreate  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublicationCreate $request)
    {
        $data = $request->all();
        $publication = $this->publicationService->create($data);

        return Redirect(route('publication.show',$publication->id));
    }

    /**
     * Display the specified publication.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publication = $this->publicationService->find($id);

        return view('publications.show',compact('publication'));
    }

    /**
     * Show the form for editing the specified publication.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $publication = $this->publicationService->find($id);

        return view('publications.edit',compact('publication'));
    }

    /**
     * Update the specified publication in database.
     *
     * @param  \App\Http\Requests\PublicationUpdate  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PublicationUpdate $request, $id)
    {
        $data = $request->all();
        if($this->publicationService->update($data,$id)){

            return Redirect(route('publication.show',$id));
        }

        return Redirect::back();
    }

    /**
     * Remove the specified publication from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->publicationService->delete($id)) {

            return Redirect('/myPublications');
        }

        return Redirect::back();
    }

    /**
     * Get all publications but my creation.
     *
     * @return \Illuminate\View\View
     */
    public function my()
    {
        $publications = $this->publicationService->my();

        return view('publications.my',compact('publications'));
    }
}
