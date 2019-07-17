<?php

namespace App\Http\Controllers;

use App\Transformers\JsonTransformer;
use App\Transformers\DataTransformer;

use Illuminate\Http\Request;

class AllowanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    

    public function index(Request $request){
        // do validation
        $this->validate($request, [
            'total_children' => 'integer|required',
            'age_children' => [
                'array', 'max:'.$request->total_children, 'min:'.$request->total_children
            ],
            'basic_sallary' => 'required|integer',
        ]);

        // transform data and do calculate
        $data = DataTransformer::transform($request);

        return JsonTransformer::response($data, 'Success');

        
    }
}