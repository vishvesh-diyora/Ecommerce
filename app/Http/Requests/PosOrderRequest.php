<?php

namespace App\Http\Requests;

use App\Enums\Activity;
use App\Enums\OrderType;
use App\Rules\ValidJsonOrder;
use Illuminate\Validation\Rule;
use Smartisan\Settings\Facades\Settings;
use Illuminate\Foundation\Http\FormRequest;

class PosOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'customer_id'     => ['required', 'numeric'],
            'subtotal'        => ['required', 'numeric'],
            'discount'        => ['nullable', 'numeric'],
            'tax'             => ['required', 'numeric'],
            'total'           => ['required', 'numeric'],
            'order_type'      => ['required', 'numeric'],
            'source'          => ['required', 'numeric'],
            'products'        => ['required', 'json', new ValidJsonOrder]
        ];
    }
}