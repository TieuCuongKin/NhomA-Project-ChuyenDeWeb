<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UploadService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    protected UploadService $uploadService;

    /**
     * @param UploadService $uploadService
     */
    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
        $this->status = Response::HTTP_OK;;
        $this->message = __('api_messages.successful');
        $this->data = [];
    }

    public function store(Request $request)
    {
        $url = $this->uploadService->uploadFile($request);
        if($url != false) {
            return response()->json([
                'error' => false,
                'url' => $url
            ]);
        };
        return response()->json(['error' => true]);
    }
}
