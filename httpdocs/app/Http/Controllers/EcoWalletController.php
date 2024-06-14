<?php

namespace App\Http\Controllers;

use App\Http\Requests\EcoWalletUpdateRequest;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EcoWalletController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $items = Items::get();
        return view('super-admin.eco-wallet.index',compact('items'));
    }


    /**
     * @param EcoWalletUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(EcoWalletUpdateRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $item = Items::findOrFail($id);
        $updateData = [
            'co2_avg' => $request->get('co2_avg'),
            'h2o_avg' => $request->get('h2o_avg'),
            'calculate_owner' => 'superadmin'
        ];

        $updated = $item->update($updateData);
        if ($updated) {
            session()->flash('success',"Item updated successfully");
        }

        return Redirect()->route('super.admin.eco-wallet.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Items::find($id);

        return view("super-admin.eco-wallet.edit",compact("data"));
    }
}
