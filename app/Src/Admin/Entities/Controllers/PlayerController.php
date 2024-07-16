<?php

namespace App\Src\Admin\Entities\Controllers;

use App\Domains\Entities\Models\Player;
use App\Domains\Operations\Models\Wallet;
use App\Http\Controllers\Controller;
use App\Src\Admin\Entities\Requests\StorePlayerRequest;
use App\Src\Admin\Entities\Requests\UpdatePlayerRequest;
use App\Src\Admin\Entities\Resources\PlayerGridResource;
use App\Src\Admin\Entities\Resources\PlayerResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlayerController extends Controller
{
    public function __construct(protected Player $player, protected Wallet $wallet)
    {
    }

    public function index()
    {
        return PlayerGridResource::collection(
            $this->player->getForGrid()
        )
            ->additional(['message' => __('shared.response_messages.success')]);
    }

    public function store(StorePlayerRequest $request)
    {
        try {
            DB::beginTransaction();

            $wallet = $this->wallet->create([
                'available' => $request->available, 'total' => $request->available,
            ]);
            $player = $this->player->create(
                array_merge($request->validated(), ['wallet_id' => $wallet->id])
            );
            if ($request->hasFile('avatar')) {
                $player->addMediaFromRequest('avatar')->toMediaCollection('players');
            }
            DB::commit();

            return $this->successResponse(
                PlayerResource::make($player->load('wallet', 'coach')),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on create  player , exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function update(UpdatePlayerRequest $request, Player $player)
    {
        try {
            DB::beginTransaction();
            $player->update($request->validated());
            $wallet = $player->wallet;
            if ($request->has('available')) {
                $this->wallet->where('id', $player->wallet_id)->update([
                    'available' => $request->available,
                    'total' => $wallet->total + $request->available,
                ]);
            } elseif ($request->has('pending')) {
                $this->wallet->where('id', $player->wallet_id)->update([
                    'pending' => $request->pending,
                    'total' => $wallet->total - $request->pending,
                ]);
            }
            if ($request->hasFile('avatar')) {
                $player->clearMediaCollection('players');
                $player->addMediaFromRequest('avatar')->toMediaCollection('players');
            }
            DB::commit();

            return $this->successResponse(
                PlayerResource::make($player->load('wallet', 'coach')),
                __('shared.response_messages.success')
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("error on create  food , exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        try {
            $player->delete();

            return $this->deletedResponse();
        } catch (\Throwable $th) {
            Log::error("error on delete player in admin app, exception: {$th->getMessage()}");

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}
