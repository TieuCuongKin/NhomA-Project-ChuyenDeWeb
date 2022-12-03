<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\LocationRepositoryInterface;
use App\Services\PostJobService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostJobController extends Controller
{
    private PostJobService $postJobService;

    private CompanyRepositoryInterface $companyRepository;

    private LocationRepositoryInterface $locationRepository;


    /**
     * @param PostJobService $postJobService
     */
    public function __construct(
        PostJobService $postJobService,
        CompanyRepositoryInterface $companyRepository,
        LocationRepositoryInterface $locationRepository,
    ) {
        $this->postJobService = $postJobService;
        $this->companyRepository = $companyRepository;
        $this->locationRepository = $locationRepository;

        $this->status = Response::HTTP_OK;;
        $this->message = __('api_messages.successful');
        $this->data = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = $this->companyRepository->getAll();
        $locations = $this->locationRepository->getAll();

        return view('admin.postjob.add', ['companies' => $companies, 'locations' => $locations] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
