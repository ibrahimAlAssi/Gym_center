<?php

use Carbon\Carbon;
use App\Domains\Entities\Models\Player;
use Illuminate\Support\Facades\Storage;
use App\Domains\Plans\Models\Subscription;
use Illuminate\Support\Facades\Notification;


if (!function_exists('uploadFile')) {
    function uploadFile($file, $folder, $diskName = "local")
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
    function getActiveSubscription($player_id)
    {
        return Subscription::join('players', 'players.id', '=', 'subscriptions.player_id')
            ->where('subscriptions.player_id', $player_id)
            ->whereDate('subscriptions.end_date', '>=', Carbon::now())
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
