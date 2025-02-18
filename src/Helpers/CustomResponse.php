<?php

namespace Suryahadiningrat\CrudGenerator\Helpers;

class CustomResponse{

    public static function success($data)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message' => 'Success get data'
        ], 200);
    }

    public static function update($request, $message = null) {
        return response()->json([
            'status' => 'success',
            'data' => $request,
            'message' => $message ?? 'Success Update Data'
        ], 200);
    }
    
    public static function create($data, $message = null)
    {
        if ($data) {
            return response()->json([
                'status' => 'success',
                'data' => $data,
                'message' => $message ?? 'Success Create Data'
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $message ?? 'Failed Create Data'
            ], 500);
        }
    }
    
    public static function delete($data, $message = null)
    {
        if($data) {
            return response()->json([
                'status' => 'success',
                'data' => null,
                'message' => $message ?? 'Success Delete Data'
            ], 200);
        }else{
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => $message ?? 'Failed Delete Data'
            ], 500);
        }
    }

    public static function notFound()
    {
        return response()->json([
            'status' => 'not found',
            'data' => null,
            'message' => 'Data Not Found'
        ], 404);
    }

    public static function badRequest($message = "Warning")
    {
        return response()->json([
            'status' => 'Warning',
            'data' => null,
            'message' => $message
        ], 400);
    }

    public static function error($message = "Error Storing Data")
    {
        return response()->json([
            'status' => 'error',
            'data' => null,
            'message' => $message
        ], 500);
    }

    public static function forbidden($message = "Forbidden")
    {
        return response()->json([
            'status' => 'Forbidden',
            'data' => null,
            'message' => $message
        ], 403);
    }
}
