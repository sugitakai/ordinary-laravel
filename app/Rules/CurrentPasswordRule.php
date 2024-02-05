<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CurrentPasswordRule implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $userId = request()->route('id');
            $user = User::find($userId);

            if (!$user) {
                throw new \Exception();
            }
            
            if (!Hash::check($value, $user->password)) {
                $fail('パスワードが一致しません');
            }
        } catch (\Exception $e) {
            $fail('パスワードが一致しません');
        }
    }
}
