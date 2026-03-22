<?php
// app/Http/Resources/ExpenseResource.php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'expense_name' => $this->expense_name,
            'amount' => $this->amount,
            'formatted_amount' => $this->formatted_amount,
            'expense_date' => $this->expense_date->format('Y-m-d'),
            'expense_date_formatted' => $this->expense_date->format('d M Y'),
            'description' => $this->description,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'created_at_formatted' => $this->created_at->diffForHumans(),
        ];
    }
}

// Update controller to use resource
// In ExpenseController index and show methods:
// return ExpenseResource::collection($expenses);
// return new ExpenseResource($expense);