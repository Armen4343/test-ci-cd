<?php

namespace App\Http\Controllers;

use App\Models\TermsAndConditions;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TermsAndConditionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $terms = TermsAndConditions::first();
        return view('super-admin.settings.terms-and-conditions', compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        //
        /*$validated = $request->validate([
                "pdf_1" => 'sometimes|mimes:pdf',
                "pdf_2" => 'sometimes|mimes:pdf',
                "pdf_3" => 'sometimes|mimes:pdf',
                "pdf_4" => 'sometimes|mimes:pdf',
             ]);*/

        $validator = Validator::make($request->all(), [
            "terms_and_condition" => 'required|mimes:pdf',
            "privacy_policy" => 'required|mimes:pdf',
            "pdf_1" => 'sometimes|mimes:pdf',
            "pdf_2" => 'sometimes|mimes:pdf',
            "pdf_3" => 'sometimes|mimes:pdf',
            "pdf_4" => 'sometimes|mimes:pdf',
        ]);

        if ($validator->fails()) {
            //return \Redirect::back()->withErrors($validator);
            return Redirect::back()->withErrors($validator);
            /*$terms = DB::table('terms_and_conditions')->first();
                     return view('super-admin.settings.terms-and-conditions', compact('terms'))->withErrors($validator);*/
        }

        $terms = TermsAndConditions::first();

        if (!$terms) {
            $terms = new TermsAndConditions();
        }

        /*$arr = '';
        if ($request->has('id')) {
            $id = $request->id;
            $data = TermsAndConditions::find($id);

            if ($request->pdf_1) {

                try {
                    unlink($data->pdf_1);
                } catch (\Throwable $th) {
                }
                $pdf_1 = $request->file('pdf_1');
                $new_pdf_1_name = rand() . '.' . $pdf_1->getClientOriginalExtension();
                $pdf_1->move(public_path('terms-and-conditions'), $new_pdf_1_name);
                $data->pdf_1 = $new_pdf_1_name;
            }
            if ($request->pdf_2) {

                try {
                    unlink($data->pdf_2);
                } catch (\Throwable $th) {
                }
                $pdf_2 = $request->file('pdf_2');
                $new_pdf_2_name = rand() . '.' . $pdf_2->getClientOriginalExtension();
                $pdf_2->move(public_path('terms-and-conditions'), $new_pdf_2_name);
                $data->pdf_2 = $new_pdf_2_name;
            }
            if ($request->pdf_3) {

                try {
                    unlink($data->pdf_3);
                } catch (\Throwable $th) {
                }
                $pdf_3 = $request->file('pdf_3');
                $new_pdf_3_name = rand() . '.' . $pdf_3->getClientOriginalExtension();
                $pdf_3->move(public_path('terms-and-conditions'), $new_pdf_3_name);
                $data->pdf_3 = $new_pdf_3_name;
            }
            if ($request->pdf_4) {

                try {
                    unlink($data->pdf_4);
                } catch (\Throwable $th) {
                }
                $pdf_4 = $request->file('pdf_4');
                $new_pdf_4_name = rand() . '.' . $pdf_4->getClientOriginalExtension();
                $pdf_4->move(public_path('terms-and-conditions'), $new_pdf_4_name);
                $data->pdf_4 = $new_pdf_4_name;
            }

            $data->save();
        } else {
            $data = new TermsAndConditions();
            if ($request->pdf_1) {
                $pdf_1 = $request->file('pdf_1');
                $new_pdf_1_name = rand() . '.' . $pdf_1->getClientOriginalExtension();
                $pdf_1->move(public_path('terms-and-conditions'), $new_pdf_1_name);
                $data->pdf_1 = $new_pdf_1_name;
            }
            if ($request->pdf_2) {
                $pdf_2 = $request->file('pdf_2');
                $new_pdf_2_name = rand() . '.' . $pdf_2->getClientOriginalExtension();
                $pdf_2->move(public_path('terms-and-conditions'), $new_pdf_2_name);
                $data->pdf_2 = $new_pdf_2_name;
            }
            if ($request->pdf_3) {
                $pdf_3 = $request->file('pdf_3');
                $new_pdf_3_name = rand() . '.' . $pdf_3->getClientOriginalExtension();
                $pdf_3->move(public_path('terms-and-conditions'), $new_pdf_3_name);
                $data->pdf_3 = $new_pdf_3_name;
            }
            if ($request->pdf_4) {
                $pdf_4 = $request->file('pdf_4');
                $new_pdf_4_name = rand() . '.' . $pdf_4->getClientOriginalExtension();
                $pdf_4->move(public_path('terms-and-conditions'), $new_pdf_4_name);
                $data->pdf_4 = $new_pdf_4_name;
            }

            $data->save();
        }*/

        if ($request->terms_and_condition) {
            $terms_and_condition = $request->file('terms_and_condition');
            $new_terms_and_condition_name = rand() . '.' . $terms_and_condition->getClientOriginalExtension();
            $terms_and_condition->move(public_path('terms-and-conditions'), $new_terms_and_condition_name);
            $terms->terms_and_condition = $new_terms_and_condition_name;
        }

        if ($request->privacy_policy) {
            $privacy_policy = $request->file('privacy_policy');
            $new_privacy_policy_name = rand() . '.' . $privacy_policy->getClientOriginalExtension();
            $privacy_policy->move(public_path('terms-and-conditions'), $new_privacy_policy_name);
            $terms->privacy_policy = $new_privacy_policy_name;
        }

        $terms->save();

        $message = 'Updated Successfully!';

        return Redirect::back()->with(compact('terms', 'message'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\TermsAndConditions $termsAndConditions
     * @return \Illuminate\Http\Response
     */
    public function show(TermsAndConditions $termsAndConditions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TermsAndConditions $termsAndConditions
     * @return \Illuminate\Http\Response
     */
    public function edit(TermsAndConditions $termsAndConditions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TermsAndConditions $termsAndConditions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TermsAndConditions $termsAndConditions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TermsAndConditions $termsAndConditions
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermsAndConditions $termsAndConditions)
    {
        //
    }
}
