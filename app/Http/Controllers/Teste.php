<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TeamPickr\DistanceMatrix\Frameworks\Laravel\DistanceMatrix;
use TeamPickr\DistanceMatrix\Licenses\StandardLicense;

class Teste extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $license = new StandardLicense('AIzaSyDf0_-4zDU3LPk7BMefAf617ot0GUXNy54');

        $response = DistanceMatrix::license($license)
            ->addOrigin('09715-340')
            ->addDestination('02221-000')
            ->request();

        dd($response);
    }
}
