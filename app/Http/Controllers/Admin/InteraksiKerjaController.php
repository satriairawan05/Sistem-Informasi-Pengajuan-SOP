<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\InteraksiKerja;
use App\Http\Controllers\Controller;

class InteraksiKerjaController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Interaksi Kerja', public $create = 0, public $read = 0, public $update = 0, public $delete = 0)
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
                    $ik = InteraksiKerja::leftJoin('departemens', 'interaksi_kerjas.departemen_id', '=', 'departemens.departemen_id')->get();
                } else {
                    $ik = InteraksiKerja::leftJoin('departemens', 'interaksi_kerjas.departemen_id', '=', 'departemens.departemen_id')->where('interaksi_kerjas.departemen_id', auth()->user()->departemen_id)->get();
                }

                return view('admin.ik.index', [
                    'name' => $this->name,
                    'interaksi_kerja' => $ik,
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
                return view('admin.ik.create', [
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
                    'ik_nama' => 'required',
                    'ik_nomor' => 'required',
                    'departemen_id' => 'required'
                ]);

                if (!$validate->fails()) {
                    $file = $request->file('ik_file');
                    InteraksiKerja::create([
                        'ik_nama' => $request->input('ik_nama'),
                        'ik_nomor' => $request->input('ik_nomor'),
                        'departemen_id' => $request->input('departemen_id'),
                        'ik_file' => $file->storeAs('Interaksi_Kerja', time() . '.' . $file->getClientOriginalExtension()),
                    ]);

                    return redirect()->to(route('interaksi_kerja.index'))->with('success', 'Data Saved!');
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
    public function show(InteraksiKerja $interaksiKerja)
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                $data = $interaksiKerja->find(request()->segment(2));
                return view('admin.ik.show', [
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
    public function download(InteraksiKerja $interaksiKerja)
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                $data = $interaksiKerja->find(request()->segment(2));
                return $this->download_file($data->ik_file);
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
    public function edit(InteraksiKerja $interaksiKerja)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                return view('admin.ik.edit', [
                    'name' => $this->name,
                    'departemen' => \App\Models\Departemen::all(),
                    'ik' => $interaksiKerja->find(request()->segment(2))
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
    public function update(Request $request, InteraksiKerja $interaksiKerja)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                $validate = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'ik_nama' => 'required',
                    'ik_nomor' => 'required',
                    'departemen_id' => 'required'
                ]);

                if (!$validate->fails()) {
                    $data = $interaksiKerja->find(request()->segment(2));
                    $file = $request->file('ik_file');
                    if ($request->hasFile('ik_file')) {
                        if ($data->ik_file != $file) {
                            \Illuminate\Support\Facades\Storage::delete($data->ik_file);
                        }
                        $filePath = $file->storeAs('Interaksi_Kerja', time() . '.' . $file->getClientOriginalExtension());
                    } else {
                        $filePath = $data->ik_file;
                    }

                    InteraksiKerja::where('ik_id',$data->ik_id)->update([
                        'ik_nama' => $request->input('ik_nama'),
                        'ik_nomor' => $request->input('ik_nomor'),
                        'departemen_id' => $request->input('departemen_id'),
                        'ik_file' => $filePath,
                    ]);

                    return redirect()->to(route('interaksi_kerja.index'))->with('success', 'Data Updated!');
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
    public function destroy(InteraksiKerja $interaksiKerja)
    {
        $this->get_access_page();
        if ($this->delete == 1) {
            try {
                $data = $interaksiKerja->find(request()->segment(2));
                $filePath = $data->ik_file;
                if ($filePath && \Illuminate\Support\Facades\Storage::exists($filePath)) {
                    \Illuminate\Support\Facades\Storage::delete($filePath);
                }
                InteraksiKerja::destroy($data->ik_id);

                return redirect()->back()->with('success', 'Data Deleted!');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }
}
