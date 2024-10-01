<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;

class HomeController
{
    public function index()
    {
        // Fetch the member count categories data
        $memberCountCategories = Team::getMemberCountCategories();

        // Pass the data to the view
        return view('home', compact('memberCountCategories'));
    }
}
