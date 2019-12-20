<?php

namespace App\Http\Hash\Perceptual;

use Illuminate\Http\UploadedFile;

Interface PerceptualInterface
{
    public function getHash(UploadedFile $master, UploadedFile $target) : array;
}
