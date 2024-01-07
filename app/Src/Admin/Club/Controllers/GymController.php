<?php

namespace App\Src\Admin\Club\Controllers;

use App\Domains\Club\Models\Gym;
use App\Http\Controllers\Controller;
use App\Src\Admin\Club\Requests\StoreGymRequest;
use App\Src\Admin\Club\Requests\UpdateGymRequest;
use Illuminate\Support\Facades\Log;

class GymController extends Controller
{
    public function __construct(protected Gym $gym)
    {
    }

    public function index()
    {
        $gym = $this->gym->first();

        return $this->successResponse($gym, 'success');
    }

    public function store(StoreGymRequest $request)
    {
        try {
            $addGym = $this->gym->create($request->validated());

            return $this->createdResponse($addGym, 'success');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdateGymRequest $request, Gym $gym)
    {
        try {
            $gym->update($request->validated());

            return $this->successResponse($gym, 'success');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Gym $gym)
    {
        try {
            $gym->delete();

            return $this->deletedResponse('deleted');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}
