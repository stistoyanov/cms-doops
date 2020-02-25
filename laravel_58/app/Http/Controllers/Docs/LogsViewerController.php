<?php

namespace App\Http\Controllers\Docs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogsViewerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show logs.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function logs()
    {
        return view('docs.logsViewer');
    }
}