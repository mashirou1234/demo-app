<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Hash\Difference\DifferenceInterface;

class SendImageController extends Controller
{
    private $difference;

    public function __construct(DifferenceInterface $difference)
    {
        $this->difference = $difference;
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

        $param = $this->difference->getHash($master, $target);
        return response()->json($param);
    }
}
