<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        // Fetch portfolios for the authenticated user or all if the user is an admin
        $portfolios = auth()->user()->hasRole('admin')
            ? Portfolio::all()
            : Portfolio::where('user_id', auth()->id())->get();

        return view('portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        // Return the view for creating a new portfolio
        return view('portfolios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'basic_information' => 'required',
            'education' => 'required',
            'work_experience' => 'required',
            'skills' => 'required',
            'personal_projects' => 'required',
            'achievements' => 'required', // Change to 'required'
        ]);
    
        $portfolio = new Portfolio();
        $portfolio->user_id = auth()->id();
        $portfolio->basic_information = $request->basic_information;
        $portfolio->education = $request->education;
        $portfolio->work_experience = $request->work_experience;
        $portfolio->skills = $request->skills;
        $portfolio->personal_projects = $request->personal_projects;
        $portfolio->achievements = $request->achievements;
        $portfolio->save();
    
        return redirect()->route('portfolios.show', $portfolio->id)->with('status', 'Portfolio Created Successfully');
    }

    public function show(Portfolio $portfolio)
    {
        // Ensure the user can view the portfolio
        $this->authorize('view', $portfolio);
    
        // Pass the portfolio to the view
        return view('portfolios.show', compact('portfolio'));
    }
    

    public function edit(Portfolio $portfolio)
    {
        // Ensure the user owns the portfolio
        $this->authorize('update', $portfolio);
    
        return view('portfolios.edit', compact('portfolio'));
    }
    
    public function update(Request $request, Portfolio $portfolio)
    {
        // Ensure the user owns the portfolio
        $this->authorize('update', $portfolio);
    
        $request->validate([
            'basic_information' => 'required',
            'education' => 'required',
            'work_experience' => 'required',
            'skills' => 'required',
            'personal_projects' => 'required',
            'achievements' => 'required',
        ]);
    
        $portfolio->basic_information = $request->basic_information;
        $portfolio->education = $request->education;
        $portfolio->work_experience = $request->work_experience;
        $portfolio->skills = $request->skills;
        $portfolio->personal_projects = $request->personal_projects;
        $portfolio->achievements = $request->achievements;
        $portfolio->save();
    
        return redirect()->route('portfolios.show', $portfolio->id)->with('status', 'Portfolio Updated Successfully');
    }
    public function review(Request $request, Portfolio $portfolio, $status)
    {
        $this->authorize('review', $portfolio);
    
        // Update the review status
        $portfolio->update(['review_status' => $status]);
    
        return redirect()->route('admin.portfolios.review')->with('status', 'Portfolio review status updated.');
    }
    

    public function reviewIndex()
    {
        $this->authorize('review', Portfolio::class);

        $portfolios = Portfolio::where('review_status', 'pending')->get();
        return view('admin.portfolio_review', compact('portfolios'));
    }

    public function destroy(Portfolio $portfolio)
    {
        // Check if the user can delete the portfolio
        $this->authorize('delete', $portfolio);

        // Delete the portfolio
        $portfolio->delete();

        return redirect()->route('portfolios.index')->with('status', 'Portfolio deleted successfully.');
    }
}
