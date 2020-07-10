<?php

namespace App\Events;

use App\Models\Employee;
use Illuminate\Queue\SerializesModels;

/**
 * Class LeaveRequestEvent
 * @package App\Events
 */
class AwardEvent
{
    use SerializesModels;

    public $employee = null;
    public $awardName = null;

    public function __construct(Employee $employee, $awardName)
    {
        $this->employee = $employee;
        $this->awardName = $awardName;
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
