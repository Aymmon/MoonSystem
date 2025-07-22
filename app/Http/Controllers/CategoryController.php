<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // Show the category creation form
    public function categoryList()
    {
        $categories = Category::all();
        return view('inventory.category', compact('categories'));
    }

    // Store the category in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('category_photos', 'public');
        }

        Category::create([
            'name' => $request->name,
            'photo' => $photoPath,
        ]);

        return redirect()->back()->with('success', 'Category created successfully!');
    }

    // Update an existing category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = $category->photo;

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($photoPath) {
                Storage::disk('public')->delete($photoPath);
            }

            $photoPath = $request->file('photo')->store('category_photos', 'public');
        }

        $category->update([
            'name' => $request->name,
            'photo' => $photoPath,
        ]);

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    // Delete a category
    public function destroy(Category $category)
    {
        // Delete photo from storage
        if ($category->photo) {
            Storage::disk('public')->delete($category->photo);
        }

        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
}
