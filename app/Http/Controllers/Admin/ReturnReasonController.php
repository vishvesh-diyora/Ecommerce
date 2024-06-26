<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Models\ReturnReason;
use App\Services\ReturnReasonService;
use App\Http\Resources\ReturnReasonResource;
use App\Http\Requests\ReturnReasonRequest;
use Exception;

class ReturnReasonController extends AdminController
{
    public ReturnReasonService $returnReasonService;

    public function __construct(ReturnReasonService $returnReasonService)
    {
        parent::__construct();
        $this->returnReasonService = $returnReasonService;
        $this->middleware(['permission:settings'])->only('show', 'store', 'update', 'destroy');
    }

    public function index(PaginateRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return ReturnReasonResource::collection($this->returnReasonService->list($request));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function store(ReturnReasonRequest $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|ReturnReasonResource|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            return new ReturnReasonResource($this->returnReasonService->store($request));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function update(ReturnReasonRequest $request, ReturnReason $returnReason): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\Foundation\Application|ReturnReasonResource
    {
        try {
            return new ReturnReasonResource($this->returnReasonService->update($request, $returnReason));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function destroy(ReturnReason $returnReason): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $this->returnReasonService->destroy($returnReason);
            return response('', 202);
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    public function show(ReturnReason $returnReason): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\Foundation\Application|ReturnReasonResource
    {
        try {
            return new ReturnReasonResource($this->returnReasonService->show($returnReason));
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], 422);
        }
    }
}
