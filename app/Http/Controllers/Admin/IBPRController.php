<?php

namespace App\Http\Controllers\Admin;

use App\Models\IBPR;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IBPRController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'IBPR', public $create = 0, public $read = 0, public $update = 0, public $delete = 0)
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
                if (auth()->user()->group_id == 1) {
                    $ibpr = IBPR::leftJoin('departemens', 'ibprs.departemen_id', '=', 'departemens.departemen_id')->get();
                } else {
                    $ibpr = IBPR::leftJoin('departemens', 'ibprs.departemen_id', '=', 'departemens.departemen_id')->where('ibprs.departemen_id', auth()->user()->departemen_id)->get();
                }

                return view('admin.ibpr.index', [
                    'name' => $this->name,
                    'ibpr' => $ibpr,
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
                return view('admin.ibpr.create', [
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
                $validate = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'ibpr_nama' => 'required',
                    'ibpr_nomor' => 'required',
                    'departemen_id' => 'required'
                ]);

                if (!$validate->fails()) {
                    $file = $request->file('ibpr_file');
                    IBPR::create([
                        'ibpr_nama' => $request->input('ibpr_nama'),
                        'ibpr_nomor' => $request->input('ibpr_nomor'),
                        'departemen_id' => $request->input('departemen_id'),
                        'ibpr_file' => $file->storeAs('IBPR', time() . '.' . $file->getClientOriginalExtension()),
                    ]);

                    return redirect()->to(route('ibpr.index'))->with('success', 'Data Saved!');
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
    public function show(IBPR $iBPR)
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                $data = $iBPR->find(request()->segment(2));
                return view('admin.ibpr.show', [
                    'name' => $this->name,
                    'file' => $data
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }

    /**
     * Display the specified resource and download file.
     */
    public function download(IBPR $iBPR)
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                $data = $iBPR->find(request()->segment(2));
                return $this->download_file($data->ibpr_file);
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
    public function edit(IBPR $iBPR)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                return view('admin.ibpr.edit', [
                    'name' => $this->name,
                    'ibpr' => $iBPR->find(request()->segment(2)),
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
    public function update(Request $request, IBPR $iBPR)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                $validate = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'ibpr_nama' => 'required',
                    'ibpr_nomor' => 'required',
                    'departemen_id' => 'required'
                ]);

                if (!$validate->fails()) {
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
    public function destroy(IBPR $iBPR)
    {
        $this->get_access_page();
        if ($this->delete == 1) {
            try {
                $data = $iBPR->find(request()->segment(2));
                $filePath = $data->ibpr_file;
                if ($filePath && \Illuminate\Support\Facades\Storage::exists($filePath)) {
                    \Illuminate\Support\Facades\Storage::delete($filePath);
                }
                IBPR::destroy($data->ibpr_id);

                return redirect()->back()->with('success', 'Data Deleted!');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }
}
