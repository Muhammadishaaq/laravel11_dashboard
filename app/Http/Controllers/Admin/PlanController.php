<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Product;
use App\Models\Plan;
use Exception;

class PlanController extends Controller
{
    // Method to store the new plan
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'features' => 'nullable|string',
        ]);

        try {
            // Create the plan in the database
            $plan = Plan::create($validatedData);

            // Set the Stripe API key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create the product in Stripe
            $stripeProduct = Product::create([
                'name' => $plan->name,
                'description' => $plan->description,
            ]);

            // Save the Stripe product ID in the database
            $plan->stripe_product_id = $stripeProduct->id;
            $plan->save();

            // Redirect back with success message
            return redirect()->back()->with('success', 'Plan created and added to Stripe successfully!');
        } catch (Exception $e) {
            // Catch and handle any errors, including from Stripe
            return redirect()->back()->withErrors(['error' => 'Error creating plan: ' . $e->getMessage()]);
        }
    }
}
