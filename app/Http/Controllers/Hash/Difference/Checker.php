<?php

namespace App\Http\Hash\Difference;

use Illuminate\Http\UploadedFile;
use Jenssegers\ImageHash\ImageHash;
use Jenssegers\ImageHash\Implementations\DifferenceHash;

Class Checker implements DifferenceInterface
{
    private $distance;
    private $hexParametor;
    private $intParametor;
    private $bitsParametor;
    private $hexMaster;
    private $hexTarget;
    private $intMaster;
    private $intTarget;
    private $bitsMaster;
    private $bitsTarget;

    public function getHash(UploadedFile $master, UploadedFile $target)
    {
        $harsher = new ImageHash(new DifferenceHash());
        $masterHash = $harsher->hash($master->getPathname());
        $targetHash = $harsher->hash($target->getPathname());
        $distance = $masterHash->distance($targetHash);

        //0であればあるほど近似画像になるので閾値の上限設定を行う
        if ($distance < 15) {
            $this->distance = 'Good to range distance: ' . $distance;
        } else {
            $this->distance = 'No matching image range distance: ' . $distance;
        }

        //toHexで出力したパラメータから画像対象の完全一致比較
        if ($masterHash->toHex() === $targetHash->toHex()) {
            $this->hexParametor = 'maybe matching string parameter: ';
            $this->hexMaster = $masterHash->toHex();
            $this->hexTarget = $targetHash->toHex();
        }
        if ($masterHash->toInt() === $targetHash->toInt()) {
            $this->intParametor = 'maybe matching int parameter: ';
            $this->intMaster = $masterHash->toInt();
            $this->intTarget = $targetHash->toInt();
        }
        if($masterHash->toBits() === $targetHash->toBits()) {
            $this->bitsParametor = 'maybe matching binary parameter: ';
            $this->bitsMaster = $masterHash->toBits();
            $this->bitsTarget = $targetHash->toBits();
        }
        return $this->resultParam = [
            'distanceResult' => $this->distance,
            'hexResult' => $this->hexParametor . "master: $this->hexMaster, target: $this->hexTarget",
            'intResult' => $this->hexParametor . "master: $this->intMaster, target: $this->intTarget",
            'bitsResult' => $this->hexParametor . "master: $this->bitsMaster, target: $this->bitsMaster"
        ];
    }
}
