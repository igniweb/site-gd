<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Homepage of the site.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('home.index', compact('request'));
    }

    /**
     * Search page (by AJAX or not).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $q = $request->get('q');
        $isAjax = $request->ajax();

        $results = app('search.engine')->search($q, $isAjax);

        $data = compact('q', 'results');
        if ($isAjax) {
            return response()->json($data);
        } else {
            return view('home.search', $data);
        }
    }
}
