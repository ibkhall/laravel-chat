<?php

namespace Khall\Chat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $dates = ['created_at', 'read_at'];

    /**
     * Message from user.
     *
     * @return BelongsTo
     */
    public function from()
    {
        return $this->belongsTo(config('khall_chat.model'), 'from_id');
    }

    /**
     * Message to user.
     *
     * @return BelongsTo
     */
    public function to()
    {
        return $this->belongsTo(config('khall_chat.model'), 'to_id');
    }
}
