<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DownloadController extends Controller
{
    /**
     * Constructor for Controller.
     */
    public function __construct(private $downloadSOP = 0, private $downloadJSA = 0, private $downloadIK = 0, private $downloadForm = 0, private $downloadIBPR = 0)
    {
        //
    }

    /**
     * Generate Access for Controller.
     */
    public function get_access_page()
    {
        $userRole = $this->get_file_access(auth()->user()->group_id);

        foreach ($userRole as $r) {
            if ($r->page_name == 'SOP') {
                if ($r->action == 'Download') {
                    $this->downloadSOP = $r->access;
                }
            }
            if ($r->page_name == 'JSA') {
                if ($r->action == 'Download') {
                    $this->downloadJSA = $r->access;
                }
            }
            if ($r->page_name == 'IBPR') {
                if ($r->action == 'Download') {
                    $this->downloadIBPR = $r->access;
                }
            }
            if ($r->page_name == 'Interaksi Kerja') {
                if ($r->action == 'Download') {
                    $this->downloadIK = $r->access;
                }
            }
            if ($r->page_name == 'Formulir') {
                if ($r->action == 'Download') {
                    $this->downloadForm = $r->access;
                }
            }
        }
    }

    /**
     * download file
     * @param  mixed $request
     * @return void
     */
    public function download(Request $request)
    {
        $this->download_file($request->file('file'));
    }
}
