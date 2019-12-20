<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Hash\Difference\DifferenceInterface;
use App\Http\Hash\Perceptual\PerceptualInterface;
use App\Http\Hash\Block\BlockInterface;
use App\Http\Hash\Average\AverageInterface;

class SendImageController extends Controller
{
    private $difference;
    private $perceptual;
    private $block;
    private $average;

    public function __construct(DifferenceInterface $difference, PerceptualInterface $perceptual, BlockInterface $block, AverageInterface $average)
    {
        $this->average = $average;
        $this->block = $block;
        $this->difference = $difference;
        $this->perceptual = $perceptual;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request)
    {
        $master = $request->cinderella;
        $target = $request->target;

        $param['average'] = $this->average->getHash($master, $target);
        $param['block'] = $this->block->getHash($master, $target);
        $param['difference'] = $this->difference->getHash($master, $target);
        $param['perceptual'] = $this->perceptual->getHash($master, $target);
        dd($param);
        return response()->json($param);
    }
}
