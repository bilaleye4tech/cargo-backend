<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Helpers
{
    # ====================================
    # *            Responses             *
    # ====================================

    public static function successResponse($message, $data = [], $pagination = false)
    {
        if ($pagination){
            return response()->json(['status' => true, 'message' => $message, 'result' => $data], config('httpstatuscodes.ok_status'));
        }else{
            return response()->json(['status' => true, 'message' => $message, 'result' => array('data' => $data)],config('httpstatuscodes.ok_status'));
        }
    }

    public static function validationResponse($errors, $request = null)
    {
        return response(['status' => false, 'message' => $errors],config('httpstatuscodes.not_acceptable_status'));
    }

    public static function unauthResponse($message = null)
    {
        return response(['status' => false, 'message' => $message],config('httpstatuscodes.unauthorized_status'));
    }

    public static function serverErrorResponse($errors)
    {
        $message = 'Something went wrong. Please contact technical support';
        if (config('app.env') == 'production')
        {
            return response()->json(['status' => false, 'message' => $message], config('httpstatuscodes.internal_server_error'));
        }else{
            return response()->json(['status' => false, 'message' => $message, 'errors' => $errors],config('httpstatuscodes.internal_server_error'));
        }
    }

    public static function forbiddenResponse($errors)
    {
        return response(['status' => false, 'message' => $errors],config('httpstatuscodes.forbidden_status'));
    }

    public static function pagination($all, $pagination = false, $per_page = null)
    {
        if ($pagination && ($pagination === true || $pagination === "true"))
        {
            if ($per_page)
            {
                $all = $all->paginate($per_page);
            }else{

                $all = $all->paginate(10);
            }

            return $all;

        }else{
            return $all->get();
        }
    }

    public static function getUser(){

        return Auth::guard('api')->user();

    }

}

