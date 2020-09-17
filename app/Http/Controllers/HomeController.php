<?php

namespace App\Http\Controllers;

use App\Http\Services\Matching;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{

    protected $matching;

    public function __construct()
    {
        $this->matching = new Matching();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function fileUpload()
    {
        return view('fileUpload');
    }

    /**
     * Upload a file.
     *
     * @param Request $request
     * @return Response
     */
    public function fileProcessing(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $fileName = time().'.'.$request->file->extension();

        $request->file->move(public_path('uploads'), $fileName);

        return $this->recommendation($fileName);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $fileName
     * @return Response
     */
    public function recommendation($fileName)
    {
        $result = $this->matching->process($fileName);

        unlink(public_path('uploads/' . $fileName));

        return view('present', ['result' => $result]);

    }
}
