<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Verification Model
 * 
 */
class Verification extends Model
{
    protected $table = 'imagefootage_verifications';
    protected $fillable = ['user_id', 'otp_type', 'one_time_password', 'otp_token', 'token_valid_date', 'max_otp_attempts', 'unsuccessful_verification_attempts', 'last_failed_attempt_at'];

    /**
     * Get User associated with the Verification
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userId()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
