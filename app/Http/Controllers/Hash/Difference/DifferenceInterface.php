<?php

namespace App\Http\Hash\Difference;

use Illuminate\Http\UploadedFile;

interface DifferenceInterface
{
    public function getHash(UploadedFile $master, UploadedFile $target) : array;
}
