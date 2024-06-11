<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HomeEval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EvaluationController extends Controller
{
    public function inputs()
    {
        $has_suite = [
            ['id' => 1, 'name' => 'No'],
            ['id' => 2, 'name' => 'Yes'],
            ['id' => 3, 'name' => 'Potential'],
        ];

        $garage = [
            ['id' => 0, 'name' => 'N/A'],
            ['id' => 1, 'name' => '1'],
            ['id' => 2, 'name' => '2'],
            ['id' => 3, 'name' => '3'],
            ['id' => 4, 'name' => '4'],
            ['id' => 5, 'name' => '5+'],
        ];

        $garage_type = [
            ['id' => 1, 'name' => 'Attached'],
            ['id' => 2, 'name' => 'Detached'],
        ];

        $basement_type = [
            ['id' => 1, 'name' => 'None'],
            ['id' => 2, 'name' => 'Full'],
            ['id' => 3, 'name' => 'Partial'],
            ['id' => 4, 'name' => 'Crawl'],
            ['id' => 5, 'name' => 'Walkout'],
        ];

        $dev_lvl = [
            ['id' => 1, 'name' => 'None'],
            ['id' => 2, 'name' => '25%'],
            ['id' => 3, 'name' => '50%'],
            ['id' => 4, 'name' => '75%'],
            ['id' => 5, 'name' => 'Complete'],
        ];

        $move_plan = [
            ['id' => 1, 'name' => '1 Month'],
            ['id' => 2, 'name' => '3 Month'],
            ['id' => 3, 'name' => '6 Month'],
            ['id' => 4, 'name' => '1 Year'],
            ['id' => 5, 'name' => '2+ Years'],
        ];

        $data = [
            'has_suite' => $has_suite,
            'garage' => $garage,
            'garage_type' => $garage_type,
            'basement_type' => $basement_type,
            'dev_lvl' => $dev_lvl,
            'move_plan' => $move_plan,
        ];

        return response()->json(['message' => 'The input options for home evaluation form are as followed:', 'data' => $data], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'year_built' => 'required|integer',
            'size' => 'required|integer',
            'bedroom' => 'required|integer',
            'bathroom' => 'required|integer',
            'half_bathroom' => 'required|integer',
            'has_suite' => 'required|integer',
            'garage' => 'required|integer',
            'garage_type' => 'required|integer',
            'basement_type' => 'required|integer',
            'dev_lvl' => 'required|integer',
            'move_plan' => 'required|integer',
            'notes' => 'required|string',
        ]);
        if ($validator->fails()) {
            $missing_fields = [];
            foreach ($validator->errors()->messages() as $key => $value) {
                $missing_fields[] = $key;
            }
            return back()->with('error', 'The following fields are required: ' . implode(', ', $missing_fields));
        }

        $homeEval = new HomeEval();
        $homeEval->fname = $request->fname;
        $homeEval->lname = $request->lname;
        $homeEval->email = $request->email;
        $homeEval->phone = $request->phone;
        $homeEval->address = $request->address;
        $homeEval->city = $request->city;
        $homeEval->state = $request->state;
        $homeEval->zip = $request->zip;
        $homeEval->year_built = $request->year_built;
        $homeEval->size = $request->size;
        $homeEval->bedroom = $request->bedroom;
        $homeEval->bathroom = $request->bathroom;
        $homeEval->half_bathroom = $request->half_bathroom;
        $homeEval->has_suite = $request->has_suite;
        $homeEval->garage = $request->garage;
        $homeEval->garage_type = $request->garage_type;
        $homeEval->basement_type = $request->basement_type;
        $homeEval->dev_lvl = $request->dev_lvl;
        $homeEval->move_plan = $request->move_plan;
        $homeEval->notes = $request->notes;
        $query = $homeEval->save();
        if (!$query) {
            return response()->json(['message' => 'Something went wrong!'], 500);
        } else {
            return response()->json(['message' => 'Your evaluation form has been submitted successfully.'], 200);
        }
    }
}