<?php
// app/Models/Expense.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Expense extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'expense_name',
        'amount',
        'expense_date',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'expense_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get formatted amount with currency.
     *
     * @return string
     */
    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount, 2) . ' ' . config('app.currency', 'SAR');
    }

    /**
     * Scope a query to only include expenses of a given date range.
     *
     * @param Builder $query
     * @param string $startDate
     * @param string $endDate
     * @return Builder
     */
    public function scopeDateBetween(Builder $query, string $startDate, string $endDate): Builder
    {
        return $query->whereBetween('expense_date', [$startDate, $endDate]);
    }

    /**
     * Scope a query to only include expenses of today.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeToday(Builder $query): Builder
    {
        return $query->whereDate('expense_date', today());
    }

    /**
     * Scope a query to only include expenses of current month.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeThisMonth(Builder $query): Builder
    {
        return $query->whereMonth('expense_date', now()->month)
                     ->whereYear('expense_date', now()->year);
    }

    /**
     * Get total expenses amount.
     *
     * @return float
     */
    public static function getTotalExpenses(): float
    {
        return self::sum('amount');
    }

    /**
     * Get daily expenses total.
     *
     * @param string $date
     * @return float
     */
    public static function getDailyTotal(string $date): float
    {
        return self::whereDate('expense_date', $date)->sum('amount');
    }
}