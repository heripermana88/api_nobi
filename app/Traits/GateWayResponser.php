<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait GateWayResponser
{
  /**
   * Build Response
   *
   * @param string|array  $data
   * @param int           $code
   * @return Illuminate\Http\JsonResponse
   */
  public function successResponse($data, $code = Response::HTTP_OK){
    return response($data,$code)->header('Content-Type','application/json');
  }

  /**
   * Build Error Response
   *
   * @param string|array  $message
   * @param int           $code
   * @return Illuminate\Http\JsonResponse
   */
  public function errorResponse($message, $code = Response::HTTP_OK){
    return response()->json(['error' => $message, 'code' => $code], $code);
  }

  /**
   * Build Error Message
   *
   * @param string|array  $message
   * @param int           $code
   * @return Illuminate\Http\JsonResponse
   */
  public function errorMessage($message, $code = Response::HTTP_OK){
    return response($message,$code)->header('Content-Type','application/json');
  }
}