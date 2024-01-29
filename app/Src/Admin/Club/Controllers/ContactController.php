<?php

namespace App\Src\Admin\Club\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Domains\Club\Models\Contact;
use App\Src\Admin\Club\Resources\ContactResource;
use App\Src\Admin\Club\Requests\StoreContactRequest;
use App\Src\Admin\Club\Requests\UpdateContactRequest;

class ContactController extends Controller
{
    public function __construct(protected Contact $contact)
    {
    }

    public function index()
    {
        $contact = $this->contact->getForGrid();

        return $this->successResponse(ContactResource::collection($contact), 'success');
    }

    public function store(StoreContactRequest $request)
    {
        try {
            $contact = $this->contact->create($request->validated());
            return $this->createdResponse(new ContactResource($contact->load('gym')), 'created');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function show(Contact $contact)
    {
        return $this->successResponse(new ContactResource($contact->load('gym')), 'success');
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        try {
            $contact->update($request->validated());

            return $this->successResponse(new ContactResource($contact), 'updated');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }

    public function destroy(Contact $contact)
    {
        try {
            $contact->delete();

            return $this->deletedResponse('deleted');
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return $this->failedResponse(__('An error occurred. Please try again later.'));
        }
    }
}
