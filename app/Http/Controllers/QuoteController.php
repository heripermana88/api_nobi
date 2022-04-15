<?php

namespace App\Http\Controllers;

use App\Services\QuotesService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\GateWayResponser;
use Illuminate\Support\Facades\Hash;

class QuoteController extends Controller
{
    use GateWayResponser;

    public $quotesService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(QuotesService $quotesService){
        $this->quotesService = $quotesService;
    }

    public function index(){
        return $this->successResponse($this->quotesService->obtainQuotes());
    }
}
