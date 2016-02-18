<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Perez_Service_Type;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class Perez_Service_TypeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $perez_service_type = Perez_Service_Type::paginate(15);

        return view('perez_service_type.index', compact('perez_service_type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('perez_service_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Perez_Service_Type::create($request->all());

        Session::flash('flash_message', 'Perez_Service_Type added!');

        return redirect('perez_service_type');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $perez_service_type = Perez_Service_Type::findOrFail($id);

        return view('perez_service_type.show', compact('perez_service_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $perez_service_type = Perez_Service_Type::findOrFail($id);

        return view('perez_service_type.edit', compact('perez_service_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        
        $perez_service_type = Perez_Service_Type::findOrFail($id);
        $perez_service_type->update($request->all());

        Session::flash('flash_message', 'Perez_Service_Type updated!');

        return redirect('perez_service_type');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        Perez_Service_Type::destroy($id);

        Session::flash('flash_message', 'Perez_Service_Type deleted!');

        return redirect('perez_service_type');
    }

}
