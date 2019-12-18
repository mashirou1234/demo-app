<?php

namespace App\Http\Hash\Block;

use Illuminate\Http\UploadedFile;

interface BlockInterface
{
    public function getHash(UploadedFile $master, UploadedFile $target) : array;
}
