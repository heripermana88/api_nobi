<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
  /**
   * Build Response
   *
   * @param string|array  $data
   * @param int           $code
   * @return Illuminate\Http\JsonResponse
   */
  public function successResponse($data, $code = Response::HTTP_OK){
    return  response()->json(['data' => $data], $code);
  }

  /**
   * Build Error Response
   *
   * @param string|array  $message
   * @param int           $code
   * @return Illuminate\Http\JsonResponse
   */
  public function errorResponse($message, $code = Response::HTTP_OK){
    return  response()->json(['error' => $message, 'code' => $code], $code);
  }
}