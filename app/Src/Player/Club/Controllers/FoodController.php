<?php

namespace App\Src\Player\Club\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Domains\Club\Models\Food;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Src\Admin\Club\Resources\FoodGridResource;

class FoodController extends Controller
{
    public function __construct(protected Food $food)
    {
    }

    public function index(Request $request)
    {
        return $this->successResponse(
            FoodGridResource::collection(
                $this->food->getForGrid()
            ),
            __('shared.response_messages.success')
        );
    }
}
