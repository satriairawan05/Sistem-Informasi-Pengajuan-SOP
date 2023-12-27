<?php

namespace App\Http\Controllers\Admin;

use App\Models\Formulir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormulirController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $name = 'Formulir', public $create = 0, public $read = 0, public $update = 0, public $delete = 0)
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
                    $form = Formulir::leftJoin('departemens', 'formulirs.departemen_id', '=', 'departemens.departemen_id')->get();
                } else {
                    $form = Formulir::leftJoin('departemens', 'formulirs.departemen_id', '=', 'departemens.departemen_id')->where('formulirs.departemen_id', auth()->user()->departemen_id)->get();
                }

                return view('admin.form.index', [
                    'name' => $this->name,
                    'formulir' => $form,
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
                return view('admin.form.create', [
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
                    'form_nama' => 'required',
                    'form_nomor' => 'required',
                    'departemen_id' => 'required'
                ]);

                if (!$validate->fails()) {
                    $file = $request->file('form_file');
                    Formulir::create([
                        'form_nama' => $request->input('form_nama'),
                        'form_nomor' => $request->input('form_nomor'),
                        'departemen_id' => $request->input('departemen_id'),
                        'form_file' => $file->storeAs('FORM', time() . '.' . $file->getClientOriginalExtension()),
                    ]);

                    return redirect()->to(route('formulir.index'))->with('success', 'Data Saved!');
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
    public function show(Formulir $formulir)
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                $data = $formulir->find(request()->segment(2));
                return view('admin.form.show', [
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
    public function download(Formulir $formulir)
    {
        $this->get_access_page();
        if ($this->read == 1) {
            try {
                $data = $formulir->find(request()->segment(2));
                return $this->download_file($data->form_file);
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
    public function edit(Formulir $formulir)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                return view('admin.form.edit', [
                    'name' => $this->name,
                    'formulir' => $formulir->find(request()->segment(2)),
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
    public function update(Request $request, Formulir $formulir)
    {
        $this->get_access_page();
        if ($this->update == 1) {
            try {
                $validate = \Illuminate\Support\Facades\Validator::make($request->all(), [
                    'form_nama' => 'required',
                    'form_nomor' => 'required',
                    'departemen_id' => 'required'
                ]);

                if (!$validate->fails()) {
                    $data = $formulir->find(request()->segment(2));
                    $file = $request->file('form_file');
                    if ($request->hasFile('form_file')) {
                        if ($data->form_file != $file) {
                            \Illuminate\Support\Facades\Storage::delete($data->form_file);
                        }
                        $filePath = $file->storeAs('FORM', time() . '.' . $file->getClientOriginalExtension());
                    } else {
                        $filePath = $data->form_file;
                    }

                    Formulir::where('form_id',$data->form_id)->update([
                        'form_nama' => $request->input('form_nama'),
                        'form_nomor' => $request->input('form_nomor'),
                        'departemen_id' => $request->input('departemen_id'),
                        'form_file' => $filePath,
                    ]);

                    return redirect()->to(route('formulir.index'))->with('success', 'Data Updated!');
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
    public function destroy(Formulir $formulir)
    {
        $this->get_access_page();
        if ($this->delete == 1) {
            try {
                $data = $formulir->find(request()->segment(2));
                $filePath = $data->form_file;
                if ($filePath && \Illuminate\Support\Facades\Storage::exists($filePath)) {
                    \Illuminate\Support\Facades\Storage::delete($filePath);
                }
                Formulir::destroy($data->form_id);

                return redirect()->back()->with('success', 'Data Deleted!');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('failed', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('failed', 'You not Have Authority!');
        }
    }
}
