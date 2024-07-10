<?php

namespace App\Src\Admin\Club\Controllers;

use App\Domains\Club\Models\Diet;
use App\Domains\Club\Models\DietFood;
use App\Http\Controllers\Controller;
use App\Src\Admin\Club\Requests\StoreDietRequest;
use App\Src\Admin\Club\Requests\UpdateDietRequest;
use App\Src\Admin\Club\Resources\DietGridResource;
use App\Src\Admin\Club\Resources\DietResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DietController extends Controller
{
    public function __construct(protected Diet $diet, protected DietFood $dietFood)
    {
    }

    public function index()
    {
        return DietGridResource::collection(
            $this->diet->getForGrid()
        )->additional(['message' => __('shared.response_messages.success')]);
    }

    public function store(StoreDietRequest $request)
    {
        try {
            DB::beginTransaction();
            $diet = $this->diet->create($request->validated());
            foreach ($request->foods as $food) {
                $data[] = [
                    'diet_id' => $diet->id,
                    'food_id' => $food['id'],
                    'allowed' => $food['allowed'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            $this->dietFood->insert($data);
            DB::commit();

            return $this->createdResponse(
                DietResource::make($diet->load('foods', 'media')),
                __('shared.response_messages.created_success')
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on store diet in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdateDietRequest $request, Diet $diet)
    {
        try {
            DB::beginTransaction();
            $diet->update($request->validated());
            if ($request->has('foods')) {
                $this->dietFood->where('diet_id', $diet->id)->delete();
                foreach ($request->foods as $food) {
                    $data[] = [
                        'diet_id' => $diet->id,
                        'food_id' => $food['id'],
                        'allowed' => $food['allowed'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                $this->dietFood->insert($data);
            }
            DB::commit();

            return $this->successResponse(
                DietResource::make($diet->load('foods')),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on store diet in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Diet $diet)
    {
        try {
            $diet->delete();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error("error on delete diet in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}
