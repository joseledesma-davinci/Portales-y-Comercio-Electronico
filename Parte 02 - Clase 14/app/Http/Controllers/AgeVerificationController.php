<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AgeVerificationController extends Controller
{
    public function form(int $id)
    {
        return view('movies.age-verification', [
            'movie' => Movie::findOrFail($id),
        ]);
    }

    public function confirm(int $id)
    {
        // TODO: Envío de emails, paginación, buscador.
        Session::put('is_over_18', true);

        return to_route('movies.show', ['movie' => $id]);
    }
}
