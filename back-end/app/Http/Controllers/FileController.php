<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    public function show($fileName)
    {
        $path = public_path() . '/images/' . $fileName;
        return Response::download($path);
    }
}
