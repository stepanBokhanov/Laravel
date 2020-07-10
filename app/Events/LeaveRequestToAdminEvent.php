<?php

namespace App\Events;

use App\Models\Admin;
use Illuminate\Queue\SerializesModels;

/**
 * Class LeaveRequestEvent
 * @package App\Events
 */
class LeaveRequestToAdminEvent
{
    use SerializesModels;

    public $admin = null;
    public $website = null;

    public function __construct(Admin $admin, $website,$dates,$leaveType, $reason)
    {
        $this->admin = $admin;
        $this->dates = $dates;
        $this->leaveType = $leaveType;
        $this->reason = $reason;
        $this->website = $website;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
    
}
