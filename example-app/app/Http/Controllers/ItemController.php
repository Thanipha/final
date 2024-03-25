<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{

    public function store(Request $request)
    {


        DB::table('items')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'created_at' => Carbon::now()

        ]);


        return redirect()->route('items.index')->with('success', 'Item created successfully!'); // Redirect with success message
    }

    public function index()
    {
        $items = Item::all(); // Get all items from database
        return view('test', compact('items')); // Pass items to the index view
    }

    public function update(Request $request, $id)
{
    $item = Item::findOrFail($id);

    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'description' => 'nullable',
        'updated_at' => Carbon::now()
    ]);


    $item->update($validatedData);
    return redirect()->route('items.index')->with('success', 'Item updated successfully!');
}
public function delete($id)
{
    $item = Item::findOrFail($id);
    $item->delete();

    return redirect()->route('items.index')->with('success', 'Item deleted successfully!');
}
public function clearItems()
{

    DB::table('items')->truncate();

    return redirect()->route('items.index')->with('success', 'All items deleted successfully!');
}
}
