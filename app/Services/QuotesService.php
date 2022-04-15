<?php
namespace App\Services;

use App\Traits\ConsumesExternalService;

class QuotesService {
    use ConsumesExternalService;

    public $baseUri;

    public function __construct(){
        $this->baseUri = config('services.quotes.base_uri');
    }

    public function obtainQuotes(){
        return $this->performRequest('GET','');
    }
}