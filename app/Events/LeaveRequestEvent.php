<?php

namespace App\Events;

use App\Models\Employee;
use Illuminate\Queue\SerializesModels;

/**
 * Class LeaveRequestEvent
 * @package App\Events
 */
class LeaveRequestEvent
{
    use SerializesModels;

    public $employee = null;
    public $date = null;
    public $status = null;

    public function __construct(Employee $employee, $date, $status)
    {
        $this->employee = $employee;
        $this->date = $date;
        $this->status = $status;
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
