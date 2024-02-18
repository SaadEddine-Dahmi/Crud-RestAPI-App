<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    public function create(Request $request)
    {
        // if (!auth()) {
        //     return redirect("/login");
        // }

        $incomingFields = $request->validate([
            "ref_titre" => "required",
            "valeur" => "required",
            "lang" => "required",
            'status' => ['required', Rule::in(['active', 'inactive'])],

        ]);


        // $model = new Item;
        // $model->ref_titre = $request->ref_titre;
        // $model->valeur = $request->valeur;
        // $model->lang = $request->lang;
        // $model->status = $request->status;
        // $model->save();

        $incomingFields["ref_titre"] = strip_tags($incomingFields["ref_titre"]);
        $incomingFields["valeur"] = strip_tags($incomingFields["valeur"]);
        $incomingFields["lang"] = strip_tags($incomingFields["lang"]);


        Item::create($incomingFields);
        return redirect()->back()->with('success', 'Item created successfully');


        // return redirect()->back();
    }

    // public function notLoggedIn()
    // {
    //     if (!auth()) {
    //         return redirect("/login");
    //     }
    // }

    public function editItem(Item $item)
    {
        return view('edit-item', ['item' => $item]);
    }
    public function updateItem(Item $item, Request $request)
    {
        $incomingFields = $request->validate([
            "ref_titre" => "required",
            "valeur" => "required",
            "lang" => "required",
            'status' => ['required', Rule::in(['active', 'inactive'])],

        ]);


        $incomingFields["ref_titre"] = strip_tags($incomingFields["ref_titre"]);
        $incomingFields["valeur"] = strip_tags($incomingFields["valeur"]);
        $incomingFields["lang"] = strip_tags($incomingFields["lang"]);

        $item->update($incomingFields);

        return redirect("/");
    }

    public function deleteItem(Item $item)
    {
        $item->delete();
        return redirect("/");
    }
}
