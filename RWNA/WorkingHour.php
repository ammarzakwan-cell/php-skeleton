<?php

namespace RWNA;

use DateTimeInterface;

class WorkingHour
{
    /**
     * @param DateTimeInterface $startTime
     * @param DateTimeInterface $endTime
     * @return array|int[]
     */
    public static function getNormalHour(DateTimeInterface $startTime, DateTimeInterface $endTime): array
    {
        $date = clone $startTime;
        $workStart = clone $date->setTime(8, 0);
        $workEnd = clone $date->setTime(17, 0);
        $breakStart = clone $date->setTime(13, 0);
        $breakEnd = clone $date->setTime(14, 0);

        if ($startTime < $workStart) {
            $startTime = $workStart;
        }

        if ($endTime > $workEnd) {
            $endTime = $workEnd;
        }

        // end time should be stored as DateTime in db
        if ($startTime >= $endTime) {
            return ['hour' => 8, 'minute' => 0];
        }

        $workingInterval = $startTime->diff($endTime);

        if ($startTime < $breakEnd && $endTime > $breakStart) {

            $breakOverlapStart = max($startTime->getTimestamp(), $breakStart->getTimestamp());
            $breakOverlapEnd = min($endTime->getTimestamp(), $breakEnd->getTimestamp());

            if ($breakOverlapStart < $breakOverlapEnd) {
                $breakDuration = $breakOverlapEnd - $breakOverlapStart;

                $breakMinutes = intdiv($breakDuration, 60);
                $breakHours = intdiv($breakMinutes, 60);
                $breakMinutes = $breakMinutes % 60;

                $workingInterval->h -= $breakHours;
                $workingInterval->i -= $breakMinutes;
            }
        }

        if ($workingInterval->i < 0) {
            $workingInterval->i += 60;
            $workingInterval->h--;
        }

        if ($workingInterval->h < 0) {
            $workingInterval->h = 0;
            $workingInterval->i = 0;
        }

        return [
            'hour' => $workingInterval->h,
            'minute' => $workingInterval->i,
        ];
    }

    /**
     * @param DateTimeInterface $endTime
     * @return float
     */
    public function getOvertimeHour(DateTimeInterface $endTime): float
    {
        $date = clone $endTime;
        $workEnd = $date->setTime(17, 0);

        $overtime = 0;

        if ($endTime > $workEnd) {
            $overtimeDuration = $endTime->getTimestamp() - $workEnd->getTimestamp();
            $overtimeMinutes = $overtimeDuration / 60;

            $fullHours = floor($overtimeMinutes / 60);
            $remainingMinutes = $overtimeMinutes % 60;

            if ($remainingMinutes > 15 && $remainingMinutes <= 45) {
                $overtime = $fullHours + 0.5;
            } elseif ($remainingMinutes > 45) {
                $overtime = $fullHours + 1;
            } else {
                $overtime = $fullHours;
            }
        }

        return $overtime;
    }
}