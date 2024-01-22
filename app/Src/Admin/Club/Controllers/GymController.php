<?php

namespace App\Src\Admin\Club\Controllers;

use App\Domains\Club\Models\Gym;
use App\Http\Controllers\Controller;
use App\Src\Admin\Club\Requests\StoreGymRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GymController extends Controller
{
    public function __construct(protected Gym $gym)
    {
    }

    public function index()
    {
        $gym = $this->gym->metaData();

        return $this->successResponse($gym, 'success');
    }

    public function store(StoreGymRequest $request)
    {
        try {
            $latitude = $request->input('location.latitude');
            $longitude = $request->input('location.longitude');
            $point = DB::raw("POINT($latitude, $longitude)");
            $name = $this->gym->first()?->name;
            $this->gym->updateOrCreate(['name' => $name], array_merge($request->validated(), ['location' => $point]));
            $data = $this->gym->metaData();

            return $this->createdResponse($data, 'success');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}
