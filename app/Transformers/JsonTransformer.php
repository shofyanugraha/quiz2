<?php
namespace App\Transformers;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
*  Class Json is transformers from raw data to json view
*/
class JsonTransformer
{
	public static function response($data = null, $message = null, $code = 200)
    {	
        if ($message==null) {
            $message = __('message.success');
        }
        if ($data==null) {
            $data = [];
        }
        
        $result = [];
        $result['message'] = $message;
        $result['status'] = true;
        
    	
		$result['data'] = $data;

	    return response()->json($result, $code);
    }

    public static function exception($message = null, $error = null, $code=400)
    {	
        if ($message==null) {
            $message = __('message.error');
        }

	    $result['message'] = $message;
	    $result['status'] = false;
        // dd();
        if ($error instanceof NotFoundHttpException) {    
            $result['error']['message'] = $error->getMessage();
            $result['error']['file'] = $error->getFile();
            $result['error']['line'] = $error->getLine();
        } elseif ($error instanceof \Exception) {    

            $result['error']['message'] = $error->getMessage();
            $result['error']['file'] = $error->getFile();
            $result['error']['line'] = $error->getLine();
        } elseif(is_array($error) && count($error) > 0) {
    	   $result['error'] = $error; 
        }
	    return response()->json($result, $code);
    }
    
}

