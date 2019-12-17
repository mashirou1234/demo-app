<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\ImageHash\ImageHash;
use Jenssegers\ImageHash\Implementations\DifferenceHash;

class SendImageController extends Controller
{
    /**
     * @var string
     */
    private $distance = '';

    private $matchingString = -10;
    /**
     * @var string
     */
    private $hexParametor = '';

    private $resultParam = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        //toHexで出力したパラメータから画像対象一致文字列の引き合い
        var_dump($masterHash->toHex(), $targetHash->toHex());
        if ($masterHash->toHex() === $targetHash->toHex()) {
            $this->hexParametor = 'maybe matching bad string parameter';
        } else {
            $this->hexParametor = 'No matching image not string parameter';
        }

        $this->resultParam = ['distanceResult' => $this->distance, 'hexResult' => $this->hexParametor];

        return response()->json($this->resultParam, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
