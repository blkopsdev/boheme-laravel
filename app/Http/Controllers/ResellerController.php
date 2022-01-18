<?php

namespace App\Http\Controllers;

use App\Reseller;

use Illuminate\Http\Request;

class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = trans('app.all_resellers');
        $resellers = Reseller::get();

        return view('dashboard.resellers.index', compact('title', 'resellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = trans('app.new_reseller');

        return view('dashboard.resellers.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'company_name' => $request->company_name,
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'main_color' => $request->main_color,
            'sub_color' => $request->sub_color,
        ];

        if ($request->hasFile('logo') != Null) {
            
            $file = $request->file('logo');
            $file_size = fileSizeMB($file->getSize());
            
            $base_name = str_replace('.' . $file->getClientOriginalExtension(), '', $file->getClientOriginalName());
            $file_name = $request->company_name . '_' . date('Ymd') . '.' . $file->getClientOriginalExtension();
            
            $destinationPath = 'uploads/resellers/';
            $file->move($destinationPath, $file_name);
            
            $data['logo_name'] = $file_name;
        }

        $reseller = Reseller::create($data);

        return redirect()->route('reseller.index')->with('success', trans('app.reseller_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reseller = Reseller::find($id);

        return view('dashboard.resellers.show', compact('reseller'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = trans('app.edit_reseller');

        $reseller = Reseller::find($id);

        return view('dashboard.resellers.edit', compact('title', 'reseller'));
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
        $reseller = Reseller::find($id);

        $data = [
            'company_name' => $request->company_name,
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'main_color' => $request->main_color,
            'sub_color' => $request->sub_color,
        ];

        if ($request->hasFile('logo') != Null) {
            $file = $request->file('logo');
            $file_size = fileSizeMB($file->getSize());
            
            $base_name = str_replace('.' . $file->getClientOriginalExtension(), '', $file->getClientOriginalName());
            $file_name = $request->company_name . '_' . date('Ymd') . '.' . $file->getClientOriginalExtension();
            
            $destinationPath = 'uploads/resellers/';
            $file->move($destinationPath, $file_name);
            
            $data['logo_name'] = $file_name;
        }

        $reseller = $reseller->update($data);

        return redirect()->back()->with('success', trans('app.reseller_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reseller = Reseller::find($id);

        $reseller->delete();

        return redirect()->route('reseller.index')->with('success', trans('app.reseller_deleted'));
    }
}
