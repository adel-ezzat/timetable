<?php

namespace App\Http\Controllers;

use App\Models\Pharmacy;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class PharmacyController extends Controller
{

    public function __construct()
    {
        $permissionName = 'Pharmacies';
        $this->middleware("permission:Show $permissionName", ['only' => ['index']]);
        $this->middleware("permission:Add $permissionName", ['only' => ['create', 'store']]);
        $this->middleware("permission:Edit $permissionName", ['only' => ['edit','update']]);
        $this->middleware("permission:Delete $permissionName", ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pharmacies = Pharmacy::all();
        return view('dashboard.pharmacy.index' , compact('pharmacies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pharmacy.create');
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
            'name' => 'required'
        ]);

        $input = $request->all();
        Pharmacy::create($input);
        return redirect()->route('pharmacy.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pharmacy = Pharmacy::find($id);
        return view('dashboard.pharmacy.edit', compact('pharmacy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input = $request->all();
        $pharmacy = Pharmacy::find($request->id);
        $pharmacy->update($input);

        return redirect()->route('pharmacy.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pharmacy  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $model = Pharmacy::whereIn('id', $request['data'])->delete();
        if ($model) {
            $arr = ['msg' => 'Deleted successfully', 'icon' => 'success'];
        } else {
            $arr = ['msg' => 'Something went wrong!', 'icon' => 'danger'];
        }

        return response()->json($arr, 200);
    }
}
