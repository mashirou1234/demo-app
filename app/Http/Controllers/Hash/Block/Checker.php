<?php

namespace App\Http\Hash\Block;

use Illuminate\Http\UploadedFile;
use Jenssegers\ImageHash\ImageHash;
use Jenssegers\ImageHash\Implementations\BlockHash;

class Checker implements BlockInterface
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

    public function getHash(UploadedFile $master, UploadedFile $target) : array
    {
        $harsher = new ImageHash(new BlockHash());
        $masterHash = $harsher->hash($master->getPathname());
        $targetHash = $harsher->hash($target->getPathname());
        $distance = $masterHash->distance($targetHash);

        //0であればあるほど近似画像になるので閾値の上限設定を行う
        if ($distance < 15) {
            $this->distance = 'Good to range distance: ' . $distance;
        } else {
            $this->distance = 'No matching image range distance: ' . $distance;
        }

        self::toHex($masterHash->toHex(), $targetHash->toHex());
        self::toInt($masterHash->toInt(), $targetHash->toInt());
        self::toBits($masterHash->toBits(), $targetHash->toBits());

        return $this->resultParam = [
            'distanceResult' => $this->distance,
            'hexResult' => $this->hexParametor . "master: $this->hexMaster, target: $this->hexTarget",
            'intResult' => $this->hexParametor . "master: $this->intMaster, target: $this->intTarget",
            'bitsResult' => $this->hexParametor . "master: $this->bitsMaster, target: $this->bitsMaster"
        ];
    }

    private function toHex($master, $target): void
    {
        if ($master === $target) {
            $this->hexParametor = 'maybe matching string parameter: ';
        }
        $this->hexMaster = $master;
        $this->hexTarget = $target;
    }

    private function toInt($master, $target): void
    {
        if ($master === $target) {
            $this->intParametor = 'maybe matching int parameter: ';
        }
        $this->intMaster = $master;
        $this->intTarget = $target;
    }

    private function toBits($master, $target): void
    {
        if ($master === $target) {
            $this->bitsParametor = 'maybe matching binary parameter: ';
        }
        $this->bitsMaster = $master;
        $this->bitsTarget = $target;
    }
}
