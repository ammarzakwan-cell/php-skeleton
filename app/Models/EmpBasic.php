<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EmpBasic extends Model
{
    protected $table = 'empbasic';

    /**
     * Get the attends daily
     */
    public function attendDaily(): HasMany
    {
        return $this->hasMany(AttendDaily::class, 'empid', 'EmpID');
    }

    /**
     * Entity methods
     */

    public function getEmployeeID(): ?string
    {
        return $this->EmpID;
    }

    public function getFullName(): ?string
    {
        return $this->LastName2_c;
    }
}