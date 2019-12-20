<?php

namespace App\Http\Hash\Average;

use Illuminate\Http\UploadedFile;

interface AverageInterface
{
    public function getHash(UploadedFile $master, UploadedFile $target) : array;
}
