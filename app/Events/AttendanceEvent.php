<?php

namespace App\Events;

use App\Models\Employee;
use Illuminate\Queue\SerializesModels;

class AttendanceEvent
{
    use SerializesModels;

    public $date = null;
    public $employee = null;

    public function __construct(Employee $employee, $date)
    {
        $this->employee = $employee;
        $this->date = $date;
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
