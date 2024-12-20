<?php

namespace App\Src\Shared;

use App\Domains\Entities\Models\Player;
use App\Domains\Plans\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

if (!function_exists('uploadFile')) {
    function uploadFile($file, $folder, $diskName = 'local')
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
        $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name
        Storage::disk($diskName)->put($folder . '/' . $fileName, file_get_contents($file));

        return $fileName;
    }
}

if (!function_exists('getPlayerWallet')) {
    function getPlayerWallet($player_id)
    {
        return Player::find($player_id)->wallet;
    }
}

if (!function_exists('getActiveSubscription')) {
    function getActiveSubscription($playerId)
    {
        return Subscription::join('players', 'players.id', '=', 'subscriptions.player_id')
            ->where('subscriptions.player_id', $playerId)
            ->whereDate('subscriptions.end_date', '>=', Carbon::now())
            ->latest('subscriptions.id')
            ->first();
    }
}

if (!function_exists('notifyPlayers')) {
    function notifyUsers($id)
    {
        $players = Player::all();
        // Notification::send($players, new NewDiscount($id));
    }
}
