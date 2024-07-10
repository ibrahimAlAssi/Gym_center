<?php

namespace App\Src\Coach\Tasks\Controllers;

use App\Domains\Tasks\Models\Type;
use App\Http\Controllers\Controller;
use App\Src\Coach\Tasks\Resources\TypeGridResource;

class TypeController extends Controller
{
    public function __construct(protected Type $type)
    {
    }

    public function index()
    {
        return $this->successResponse(
            TypeGridResource::collection($this->type->getForGrid()),
            __('shared.response_messages.success')
        );
    }
}
