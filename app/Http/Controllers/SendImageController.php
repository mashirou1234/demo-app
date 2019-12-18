<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Hash\Difference\DifferenceInterface;
use App\Http\Hash\Perceptual\PerceptualInterface;
use App\Http\Hash\Block\BlockInterface;

class SendImageController extends Controller
{
    private $difference;
    private $perceptual;

    public function __construct(DifferenceInterface $difference, PerceptualInterface $perceptual, BlockInterface $block)
    {
        $this->difference = $difference;
        $this->perceptual = $perceptual;
        $this->block = $block;
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

        $param['block'] = $this->block->getHash($master, $target);
        $param['difference'] = $this->difference->getHash($master, $target);
        $param['perceptual'] = $this->perceptual->getHash($master, $target);
        dd($param);
        return response()->json($param);
    }
}
