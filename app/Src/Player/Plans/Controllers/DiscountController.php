<?php

namespace App\Src\Player\Plans\Controllers;

use App\Domains\Plans\Models\Discount;
use App\Http\Controllers\Controller;
use App\Src\Player\Plans\Resources\DiscountGridResource;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function __construct(protected Discount $discount)
    {
    }

    public function index(Request $request)
    {
        return $this->successResponse(
            DiscountGridResource::collection(
                $this->discount->getForGrid(active: true)
            ),
            __('shared.response_messages.success')
        );
    }
}
