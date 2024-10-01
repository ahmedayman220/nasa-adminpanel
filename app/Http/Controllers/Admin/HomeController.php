<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;

class HomeController
{
    public function index()
    {
        // Fetch the member count categories data
        $memberCountCategories = Team::getMemberCountCategories();
        $OnsiteMemberCountCategories = Team::getMemberCountCategoriesForAcceptedOnsite();

        // Pass the data to the view
        return view('home', compact('memberCountCategories', 'OnsiteMemberCountCategories'));
    }
}
