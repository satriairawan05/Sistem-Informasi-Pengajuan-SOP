<?php

namespace App\Http\Controllers\Admin;

use App\Models\JSA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JSAController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'JSA', public $create = 0, public $read = 0, public $update = 0, public $delete = 0)
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
                    $jsa = JSA::leftJoin('departemens', 'jsas.departemen_id', '=', 'departemens.departemen_id')->get();
                } else {
                    $jsa = JSA::leftJoin('departemens', 'jsas.departemen_id', '=', 'departemens.departemen_id')->where('jsas.departemen_id', auth()->user()->departemen_id)->get();
                }

                return view('admin.jsa.index', [
                    'name' => $this->name,
                    'jsa' => $jsa,
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
                return view('admin.jsa.create', [
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
                    'jsa_nama' => 'required',
                    'jsa_nomor' => 'required',
                    'departemen_id' => 'required'
                ]);

                if (!$validate->fails()) {
                    $file = $request->file('jsa_file');
                    JSA::create([
                        'jsa_nama' => $request->input('jsa_nama'),
                        'jsa_nomor' => $request->input('jsa_nomor'),
                        'departemen_id' => $request->input('departemen_id'),
                        'jsa_file' => $file->storeAs('JSA', time() . '.' . $file->getClientOriginalExtension()),
                    ]);

                    return redirect()->to(route('jsa.index'))->with('success', 'Data Saved!');
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
    public function show(JSA $jSA)
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                $data = $jSA->find(request()->segment(2));
                return view('admin.jsa.show', [
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
    public function download(JSA $jSA)
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                $data = $jSA->find(request()->segment(2));
                return $this->download_file($data->jsa_file);
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
    public function edit(JSA $jSA)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                return view('admin.jsa.edit', [
                    'name' => $this->name,
                    'departemen' => \App\Models\Departemen::all(),
                    'jsa' => $jSA->find(request()->segment(2))
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
    public function update(Request $request, JSA $jSA)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                $validate = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'jsa_nama' => 'required',
                    'jsa_nomor' => 'required',
                    'departemen_id' => 'required'
                ]);

                if (!$validate->fails()) {
                    $data = $jSA->find(request()->segment(2));
                    $file = $request->file('jsa_file');
                    if ($request->hasFile('jsa_file')) {
                        if ($data->jsa_file != $file) {
                            \Illuminate\Support\Facades\Storage::delete($data->jsa_file);
                        }
                        $filePath = $file->storeAs('JSA', time() . '.' . $file->getClientOriginalExtension());
                    } else {
                        $filePath = $data->jsa_file;
                    }

                    JSA::where('jsa_id',$data->jsa_id)->update([
                        'jsa_nama' => $request->input('jsa_nama'),
                        'jsa_nomor' => $request->input('jsa_nomor'),
                        'departemen_id' => $request->input('departemen_id'),
                        'jsa_file' => $filePath,
                    ]);

                    return redirect()->to(route('jsa.index'))->with('success', 'Data Updated!');
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
    public function destroy(JSA $jSA)
    {
        $this->get_access_page();
        if ($this->delete == 1) {
            try {
                $data = $jSA->find(request()->segment(2));
                $filePath = $data->jsa_file;
                if ($filePath && \Illuminate\Support\Facades\Storage::exists($filePath)) {
                    \Illuminate\Support\Facades\Storage::delete($filePath);
                }
                JSA::destroy($data->jsa_id);

                return redirect()->back()->with('success', 'Data Deleted!');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }
}
