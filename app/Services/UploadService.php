<?php

namespace App\Services;

class UploadService
{
    public function uploadFile($request)
    {
        if($request->hasFile('file'))
        {
            try {
                $name = $request->file('file')->getClientOriginalName();

                $pathFull = 'uploads/' .  date("Y/m/d");

                $path = $request->file('file')->storeAs(
                    'public/' . $pathFull, $name
                );

                return '/storage/' . $pathFull . '/' . $name;
            } catch (\Exception $exception) {
                return false;
            }
        }
    }
}