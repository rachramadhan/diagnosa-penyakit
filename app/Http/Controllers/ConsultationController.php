<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disease;

class ConsultationController extends Controller
{
    /** @var  Disease */
    private $disease;

    public function __construct(Disease $disease)
    {
        $this->disease = $disease;
    }

    /**
     * Display a listing of the Disease.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('consultations.index');
    }

    /**
     * Store a newly created Disease in storage.
     *
     * @param CreateDiseaseRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $diagnose = $request->input('diagnose');
        $singleReturn = false;
        $disease = null;

        $result = $this->disease->searchDiagnose( $diagnose, $singleReturn );

        if ( $singleReturn ) {
            $disease = $result[ "disease" ];
        }

        return view( 'consultations.show' )
            ->with( 'result', $result )
            ->with( 'disease', $disease )
            ->with( 'diagnose', $diagnose )
            ->with( 'singleReturn', $singleReturn );
    }
}
