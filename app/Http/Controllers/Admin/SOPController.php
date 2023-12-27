<?php

namespace App\Http\Controllers\Admin;

use App\Models\SOP;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SOPController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'SOP', public $create = 0, public $read = 0, public $update = 0, public $delete = 0)
    {
        //
    }

    /**
     * Generate Access for Controller.
     */
    public function get_access_page()
    {
        $userRole = $this->get_access($this->name, auth()->user()->group_id);

        foreach ($userRole as $r) {
            if ($r->page_name == $this->name) {
                if ($r->action == 'Create') {
                    $this->create = $r->access;
                }

                if ($r->action == 'Read') {
                    $this->read = $r->access;
                }

                if ($r->action == 'Update') {
                    $this->update = $r->access;
                }

                if ($r->action == 'Delete') {
                    $this->delete = $r->access;
                }
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                return view('admin.sop.index', [
                    'name' => $this->name,
                    'sop' => SOP::leftJoin('departemens','sops.departemen_id','=','departemens.departemen_id')->get(),
                    'pages' => $this->get_access($this->name, auth()->user()->group_id)
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->get_access_page();
        if ($this->create == 1) {
            try {
                return view('admin.sop.create', [
                    'name' => $this->name,
                    'departemen' => \App\Models\Departemen::all()
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->get_access_page();
        if ($this->create == 1) {
            try {
                $validate = \Illuminate\Support\Facades\Validator::make($request->all(),[
                    'sop_nama' => 'required',
                    'sop_nomor' => 'required',
                    'departemen_id' => 'required'
                ]);

                if(!$validate->fails()){
                    $file = $request->file('sop_file');
                    SOP::create([
                        'sop_nama' => $request->input('sop_nama'),
                        'sop_nomor' => $request->input('sop_nomor'),
                        'departemen_id' => $request->input('departemen_id'),
                        'sop_file' => $file->storeAs('SOP', time() . '.' . $file->getClientOriginalExtension()),
                    ]);

                    return redirect()->to(route('sop.index'))->with('success','Data Saved!');
                } else {
                    return redirect()->back()->with('failed', $validate->getMessageBag());
                }
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SOP $sOP)
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                $data = $sOP->find(request()->segment(2));
                return view('admin.sop.show', [
                    'name' => $this->name,
                    'file' => asset('storage/'.$data->sop_file)
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SOP $sOP)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                return view('admin.sop.edit', [
                    'name' => $this->name,
                    'sop' => $sOP->find(request()->segment(2)),
                    'departemen' => \App\Models\Departemen::all()
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SOP $sOP)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                $validate = \Illuminate\Support\Facades\Validator::make($request->all(),[
                    'sop_nama' => 'required',
                    'sop_nomor' => 'required',
                    'departemen_id' => 'required'
                ]);

                if(!$validate->fails()){
                    //
                } else {
                    return redirect()->back()->with('failed', $validate->getMessageBag());
                }
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SOP $sOP)
    {
        $this->get_access_page();
        if ($this->delete == 1) {
            try {
                $data = $sOP->find(request()->segment(2));
                $filePath = $data->sop_file;
                if ($filePath && \Illuminate\Support\Facades\Storage::exists($filePath)) {
                    \Illuminate\Support\Facades\Storage::delete($filePath);
                }
                SOP::destroy($data->sop_id);

                return redirect()->back()->with('success','Data Deleted!');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }
}
