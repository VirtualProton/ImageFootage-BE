<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiscountMessage;
use Illuminate\Support\Facades\Validator;

class DiscountMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discountMessages = new DiscountMessage;
        $discountMessages = $discountMessages->all()->toArray();
        return view('admin.discount-message.index', ['discountMessages' => $discountMessages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.discount-message.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_type' => 'required',
            'title' => 'required',
            'link' => 'required',
            'button_text' => 'required',
            'status' => 'required',
        ], [
            'page_type.required' => 'The Page Type field is required.',
            'title.required' => 'The Title field is required.',
            'link.required' => 'The Link field is required.',
            'button_text.required' => 'The Button Text field is required.',
            'status.required' => 'The Status field is required.'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        if (DiscountMessage::where('page_type', $request->input('page_type'))->count() > 0) {
            return back()->withInput()->with('error', 'Record already exist for this page type.');
        }
        $discountMessage = DiscountMessage::create([
            'page_type' => $request->input('page_type'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'link' => $request->input('link'),
            'button_text' => $request->input('button_text'),
            'status' => $request->input('status'),
        ]);
        $result = $discountMessage->save();
        if ($result) {
            return back()->with('success', 'Discount Message Save Successfully.');
        } else {
            return back()->with('warning', 'Some problem occured.');
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
        $discountMessage = DiscountMessage::find($id)->toArray();
        return view('admin.discount-message.edit', ['discountMessage' => $discountMessage]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page_type' => 'required',
            'title' => 'required',
            'link' => 'required',
            'button_text' => 'required',
            'status' => 'required',
        ], [
            'page_type.required' => 'The Page Type field is required.',
            'title.required' => 'The Title field is required.',
            'link.required' => 'The Link field is required.',
            'button_text.required' => 'The Button Text field is required.',
            'status.required' => 'The Status field is required.'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        if (DiscountMessage::where('page_type', $request->input('page_type'))->where('id', '!=', $request->input('id'))->count() > 0) {
            return back()->withInput()->with('error', 'Record already exist for this page type.');
        }
        $result = DiscountMessage::where('id', $request->input('id'))->update([
            'page_type' => $request->input('page_type'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'link' => $request->input('link'),
            'button_text' => $request->input('button_text'),
            'status' => $request->input('status'),
        ]);
        if ($result) {
            return back()->with('success', 'Discount Message Updated Successfully.');
        } else {
            return back()->with('warning', 'Some problem occured.');
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
        $del_result = DiscountMessage::find($id)->delete();
        if ($del_result) {
            return back()->with('success', 'Discount Message Deleated Successfully.');
        } else {
            return back()->with('warning', 'Some problem occured.');
        }
    }

    public function changeStatus($status, $id)
    {
        $result = DiscountMessage::where('id', $id)->update(array('status' => $status));
        if ($result) {
            return back()->with('success', 'Discount message status changed successfully.');
        } else {
            return back()->with('warning', 'Some problem occured.');
        }
    }

    // API
    public function discountMessagesList(Request $request){
        $discount_message_list = DiscountMessage::get()->toArray();
        return json_encode($discount_message_list);
    }
}
