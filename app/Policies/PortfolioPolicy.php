<?php

// app/Policies/PortfolioPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\Portfolio;

class PortfolioPolicy
{
    /**
     * Create a new policy instance.
     */
    public function view(User $user, Portfolio $portfolio)
{
    // Admins and the owner of the portfolio can view it
    return $user->hasRole('admin') || $user->id === $portfolio->user_id;
}


    /**
     * Determine if the user can create portfolios.
     */
    public function create(User $user)
    {
        // Allow only alumni (non-admins) to create portfolios
        return !$user->hasRole('admin');
    }

    /**
     * Determine if the user can review portfolios.
     */
    public function review(User $user)
    {
        // Allow only admins to review portfolios
        return $user->hasRole('admin');
    }

    /**
     * Determine if the user can update the portfolio.
     */
   // app/Policies/PortfolioPolicy.php

public function update(User $user, Portfolio $portfolio)
{
    // Only allow users to edit their own portfolios; admins should not have this permission
    return $user->id === $portfolio->user_id;
}


    /**
     * Determine if the user can delete the portfolio.
     */
    public function delete(User $user, Portfolio $portfolio)
    {
        // Allow only the owner of the portfolio or admins to delete
        return $user->id === $portfolio->user_id || $user->hasRole('admin');
    }
}

