<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PromoCode;

class PromoCodeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except('login','logout');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promocodes = PromoCode::orderBy('id', 'DESC')->get()->toArray();
        return view('admin.promo-code.index',compact('promocodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promo-code.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'            => 'required',
            'type'            => 'required',
            'max_usage'       => 'required',
            'valid_type'      => 'required',
            'valid_till_date' => 'required|date',
            'status'          => 'required',
        ]);

        $insertableData = [
            'name'            => $request->name,
            'type'            => $request->type,
            'max_usage'       => $request->max_usage,
            'valid_upto_type' => $request->valid_type,
            'valid_till_date' => $request->valid_till_date,
            'status'          => $request->status,
        ];
        
        if (PromoCode::insert($insertableData)) {
            return redirect("admin/promo-codes")->with("success", "Promo code has been created successfully !");
        } else {
            return redirect("admin/promo-codes")->with("error", "Due to some error, Promo code is not created yet. Please try again!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promoCode = PromoCode::find($id);
        return view('admin.promo-code.edit', compact('promoCode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'            => 'required',
            'type'            => 'required',
            'max_usage'       => 'required',
            'valid_type'      => 'required',
            'valid_till_date' => 'required|date',
            'status'          => 'required',
        ]);

        $promoCode                  = PromoCode::find($id);
        $promoCode->name            = $request->name;
        $promoCode->type            = $request->type;
        $promoCode->max_usage       = $request->max_usage;
        $promoCode->valid_upto_type = $request->valid_type;
        $promoCode->valid_till_date = $request->valid_till_date;
        $promoCode->status          = $request->status;

        if ($promoCode->save()) {
            return redirect("admin/promo-codes")->with("success", "Promo code has been updated successfully !");
        } else {
            return redirect("admin/promo-codes/$id/edit")->with("error", "Due to some error, Promo code is not updated yet. Please try again!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
