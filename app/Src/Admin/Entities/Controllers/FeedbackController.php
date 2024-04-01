<?php

namespace App\Src\Admin\Entities\Controllers;

use App\Domains\Entities\Models\Feedback;
use App\Http\Controllers\Controller;
use App\Src\Admin\Entities\Resources\FeedbackGridResource;

class FeedbackController extends Controller
{
    public function __construct(protected Feedback $feedback)
    {
    }

    public function index()
    {
        return FeedbackGridResource::collection($this->feedback->getForGrid());
    }
}
