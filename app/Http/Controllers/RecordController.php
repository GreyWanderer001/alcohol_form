<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;

class RecordController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function fetch(Request $request)
    {
        $request->validate(['REQUEST_ID' => 'required|integer']);
        
        $record = Record::on('sqlsrv')->where('REQUEST_ID', $request->REQUEST_ID)->first();
        
        if (!$record) {
            return redirect()->back()->withErrors(['REQUEST_ID' => 'Record not found']);
        }

        return view('record', compact('record'));
    }

    public function update(Request $request, $REQUEST_ID)
    {
        
        try {
            $data = $request->except('_token', '_method', 'ALCOHOL_CASES_HIDDEN');
            $data['ALCOHOL_CASES'] = $request->input('ALCOHOL_CASES_HIDDEN');
    
            $record = Record::find($REQUEST_ID);
    
            if (!$record) {
                return response()->json(['status' => 'error', 'message' => 'Record not found']);
            }
    
            $record->update($data);
    
            return redirect()->route('record.index')->with('success', 'Record updated successfully');
    
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Error updating record: ' . $e->getMessage()]);
        }                   
    }
}
