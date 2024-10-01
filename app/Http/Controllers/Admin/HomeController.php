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
        $Onsiteteams = Team::withCount('members')->where('status' , 'accepted_onsite')->get();
        $Onsiteteams = $Onsiteteams->sortByDesc('members_count');
        // Pass the data to the view
        return view('home', compact('memberCountCategories', 'OnsiteMemberCountCategories', 'Onsiteteams'));
    }
}
