<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $title = "Home";
        return view('pages.index')->with('title',$title);
    }

    public function about()
    {
        $title = "About";
        return view('pages.about')->with('title',$title);
    }

    public function services()
    {
        $data = array(
            'title' => 'Services',
            'services' => ['Web-Design','Internet-Marketing','Graphic-Design','SEO','Software-Development']
        );
        return view('pages.services')->with($data);
    }
}
