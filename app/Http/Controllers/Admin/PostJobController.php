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
     */
    public function index(?Request $request)
    {
        $data = $this->postJobService->getListJobs($request?->search);

        return view('admin.postjob.list', ['jobs' => $data]);
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

    public function store(Request $request)
    {
        $this->postJobService->createNewJob($request->all());

        return redirect()->route('admin.postjob.index');
    }

    public function show($id)
    {
        $data = $this->postJobService->getJobById($id);

        return view('admin.postjob.detail',['job' => $data]);
    }

    public function edit($id)
    {
        $companies = $this->companyRepository->getAll();
        $locations = $this->locationRepository->getAll();
        $data = $this->postJobService->getJobById($id);

        return view('admin.postjob.edit',['companies' => $companies, 'locations' => $locations, 'job' => $data]);
    }

    public function update(Request $request, $id)
    {
        $this->postJobService->updateJob($id, $request->all());

        return redirect()->route('admin.postjob.index');
    }

    public function destroy($id)
    {
        if($this->postJobService->deleteJob($id))
        {
            return redirect()->route('admin.company.list');
        }

        return redirect()->back();
    }
}
