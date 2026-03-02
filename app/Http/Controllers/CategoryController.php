<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Créer la catégorie
        Category::create([
            'name' => $request->name,
        ]);

        // Redirection
        return redirect()->route('colocations.index')
                     ->with('success', 'Dépense ajoutée avec succès !');
    }

}
