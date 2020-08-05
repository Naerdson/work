<?php

namespace App\Http\Controllers\Admin\Config;

use App\Http\Controllers\Controller;
use App\Models\TokenApi;
use Exception;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function create()
    {
        $tokens = TokenApi::all();
        return view('admin.config.create', compact('tokens'));
    }

    public function getToken()
    {
        $token = TokenApi::generateTokenApi();
        return response()->json(['token' => $token]);
    }

    public function store(Request $request)
    {
        try {
            $tokenApiSave = TokenApi::create($request->except('_token'));

            if($tokenApiSave) {
                return redirect()->back()->with(['type' => 'success', 'message' => 'Token salvo com sucesso']);
            }
            
            return redirect()->back()->with(['type' => 'success', 'message' => 'Token salvo com sucesso' ]);

        } catch (Exception $e) {
            return redirect()->back()->with(['type' => 'success', 'message' => $e->getMessage()]);
        }
    }
}
