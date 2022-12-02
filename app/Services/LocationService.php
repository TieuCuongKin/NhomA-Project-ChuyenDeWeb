<?php

namespace App\Services;

use App\Repositories\LocationRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Throwable;

class LocationService
{
    private LocationRepositoryInterface $locationRepository;

    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    public function listLocation()
    {
        return $this->locationRepository->getAllLocation();
    }

    public function createListLocation()
    {
        DB::beginTransaction();
        try {
            $data = Http::get('https://provinces.open-api.vn/api/p')->json();
            foreach ($data as $value)
            {
               $this->locationRepository->loadLocation(['location_name' => $value['name']]) ;
            }
            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}