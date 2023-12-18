<?php

namespace App\Http\Controllers;

use App\Repository\JobRepository;
use DTApi\Http\Controllers\Controller;
use DTApi\Models\Job;
use DTApi\Http\Requests;
use DTApi\Models\Distance;
use Illuminate\Http\Request;
use DTApi\Repository\BookingRepository;
use function DTApi\Http\Controllers\array_except;
use function DTApi\Http\Controllers\config;
use function DTApi\Http\Controllers\env;
use function DTApi\Http\Controllers\response;

/**
 * Class BookingController
 * @package DTApi\Http\Controllers
 */
class JobsController extends Controller
{

    /**
     * @var JobRepository
     */
    protected $repository;

    /**
     * JobController constructor.
     * @param JobRepository $jobRepository
     */
    public function __construct(JobRepository $jobRepository)
    {
        $this->repository = $jobRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $userType = auth()->user()->user_type;

        if ($user_id = $request->get('user_id')) {
            $response = $this->repository->getUsersJobs($user_id);
        } elseif ($userType == config('constants.ADMIN_ROLE_ID') || $userType == config('constants.SUPERADMIN_ROLE_ID')) {
            $response = $this->repository->getAll($request);
        }

        return response()->json($response);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $job = $this->repository->with('translatorJobRel.user')->findOrFail($id);
            return $job->toJson();
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Job not found'], 404);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(StoreJobRequest $request)
    {
        $data = $request->all();

        $response = $this->repository->store($request->user(), $data);

        return response()->json($response);

    }

    /**
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function update($id, UpdateJobRequest $request)
    {
        $data = $request->all();
        $response = $this->repository->updateJob($id, array_except($data, ['_token', 'submit']), auth()->user());

        return response()->json($response);
    }

}
