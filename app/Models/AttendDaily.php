<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class AttendDaily extends Model
{
    protected $table = 'attend_daily';

    /**
     * Entity methods
     */

    public function getDate(): ?DateTimeInterface
    {
        if (is_string($this->date)) {
            return date_create($this->date);
        }
        if ($this->date instanceof DateTimeInterface) {
            return $this->date;
        }
        return null;
    }

    public function getInTime1(): DateTimeInterface
    {
        return date_create($this->date . ' ' . $this->InTime1);
    }

    public function getOutTime2(): DateTimeInterface
    {
        return date_create($this->date . ' ' . $this->OutTime2);
    }
}