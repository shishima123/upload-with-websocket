<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\UploadEvent;

class UploadController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function upload(Request $request) {
        event(new UploadEvent(1));
        sleep(2);
        event(new UploadEvent(2));
        sleep(2);
        event(new UploadEvent(3));
        return 'success';
    }
}
