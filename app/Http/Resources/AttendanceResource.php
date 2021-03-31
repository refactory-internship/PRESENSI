<?php

namespace App\Http\Resources;

use App\Enums\AttendanceApprover;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        if ($this->approvedBy == AttendanceApprover::SYSTEM) {
            $approvedBy = 'SYSTEM';
        } else {
            $approvedBy = 'PARENT';
        }

        if ($this->approverId !== null) {
            $approver =  $this->user->parent->getFullNameAttribute();
        } else {
            $approver = 'Automatically Approved By System';
        }

        if ($this->isQRCode === true) {
            $isQRCode = 'YES';
        } else {
            $isQRCode = 'NO';
        }

        if ($this->approvalStatus === '1') {
            $approvalStatus = 'NEEDS_APPROVAL';
        } elseif ($this->approvalStatus === '2') {
            $approvalStatus = 'CLOCK_OUT_ALLOWED';
        } elseif ($this->approvalStatus === '3') {
            $approvalStatus = 'APPROVED';
        } elseif ($this->approvalStatus === '4') {
            $approvalStatus = 'REJECTED';
        }

        return [
            'Attendance ID' => $this->id,
            'Employee Name' => $this->user->getFullNameAttribute(),
            'Attendance Date' => date('d F Y', strtotime($this->calendar->date)),
            'Attendance Approver' => $approvedBy,
            'Attendance Approver Name' => $approver,
            'QR Code Attendance' => $this->isQRCode,
            'GPS Latitude' => $this->gps_lat,
            'GPS Longitude' => $this->gps_long,
            'Clock-In Time' => $this->clock_in_time,
            'Task Plan' => $this->task_plan,
            'Task Report' => $this->task_report,
            'Clock-Out Time' => $this->clock_out_time,
            'Attendance Note' => $this->note,
            'Attendance Approval Status' => $approvalStatus,
            'Reason of Rejection' => $this->rejectionNote
        ];
    }
}
