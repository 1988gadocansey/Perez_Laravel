<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models;
use App\Http\Controllers\Controller;

use App\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class LogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $log = Models\Log::paginate(15);

        return view('log.index', compact('log'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('log.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, ['theid' => 'required', 'thepass' => 'required', 'name' => 'required', 'branch' => 'required', 'bank' => 'required', 'ip' => 'required', 'status' => 'required', ]);
        $request["thepass"]=md5($request["thepass"]);
        Models\Log::create($request->all());

        Session::flash('success_message', 'User added!');

        return redirect('log');
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
        $log = Models\Log::findOrFail($id);

        return view('log.show', compact('log'));
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
        $log = Models\Log::findOrFail($id);

        return view('log.edit', compact('log'));
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
        $this->validate($request, ['theid' => 'required', 'thepass' => 'required', 'name' => 'required', 'branch' => 'required', 'bank' => 'required', 'ip' => 'required', 'status' => 'required', ]);

        $log = Models\Log::findOrFail($id);
        $log->update($request->all());

        Session::flash('success_message', 'User updated!');

        return redirect('log');
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
        Models\Log::destroy($id);

        Session::flash('success_message', 'User deleted!');

        return redirect('log');
    }

}
