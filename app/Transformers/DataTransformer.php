<?php
namespace App\Transformers;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;
/**
*  Class Json is transformers from raw data to json view
*/
class DataTransformer
{
	public static function transform(Request $request)
    {	

        $data = [];

        $data['basic_sallary'] = $request->basic_sallary;

        $data['allowances'] = [];       

        // calculate allowance
        if(is_array($request->age_children) && count($request->age_children) > 0) {
            foreach($request->age_children as $age){
                if ($age >= 1 && $age <=5){
                    $percentage = 0.05;
                } elseif ($age >= 6 && $age <= 10){
                    $percentage = 0.07;
                } elseif ($age >= 11 && $age <= 15) {
                    $percentage = 0.10;
                } else {
                    continue;
                }
                $data['allowances'][]    = [
                    'age' => $age,
                    'percentage' => $percentage,
                    'allowance' => (int) ($percentage * $data['basic_sallary'])
                ];
            }
        }
        $data['allowances'] = collect($data['allowances'])->sortByDesc('age')->take(2)->values();
        $data['total_allowance'] = $data['allowances']->sum('allowance');
        $data['total_sallary'] = $data['total_allowance'] + $data['basic_sallary'];

        return $data;
    }
}

