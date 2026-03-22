<?php
// app/Http/Requests/ExpenseRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Modify based on your authentication logic
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'expense_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01|max:99999999.99',
            'expense_date' => 'required|date|before_or_equal:today',
            'description' => 'nullable|string|max:1000',
        ];

        // Additional rules for update
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['expense_name'] = 'sometimes|required|string|max:255';
            $rules['amount'] = 'sometimes|required|numeric|min:0.01|max:99999999.99';
            $rules['expense_date'] = 'sometimes|required|date|before_or_equal:today';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'expense_name.required' => 'اسم المصروف مطلوب',
            'expense_name.max' => 'اسم المصروف لا يجب أن يتجاوز 255 حرف',
            'amount.required' => 'المبلغ مطلوب',
            'amount.numeric' => 'المبلغ يجب أن يكون رقماً',
            'amount.min' => 'المبلغ يجب أن يكون أكبر من 0',
            'amount.max' => 'المبلغ كبير جداً',
            'expense_date.required' => 'تاريخ المصروف مطلوب',
            'expense_date.date' => 'صيغة التاريخ غير صحيحة',
            'expense_date.before_or_equal' => 'لا يمكن إضافة مصروف بتاريخ مستقبلي',
            'description.max' => 'الوصف لا يجب أن يتجاوز 1000 حرف',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        // Clean and format amount
        if ($this->has('amount')) {
            $this->merge([
                'amount' => str_replace(',', '', $this->amount),
            ]);
        }
    }
}