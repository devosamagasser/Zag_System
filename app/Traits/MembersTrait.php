<?php

namespace App\Traits;

use App\Models\Members;

trait MembersTrait
{
    public function filterConditions(): \Illuminate\Database\Eloquent\Collection|array
    {
        $members = Members::with(['position', 'committee']); // Initialize the query builder

        if ($filter = request('filter')) {
            if (!is_null($filter['section'])) {
                $members = $this->filter($members, 'committee', 'section_id', $filter['section']);
            }
            if (!is_null($filter['committee'])) {
                $members = $this->filter($members, 'committee', 'committee_id', $filter['committee']);
            }
            if (!is_null($filter['position'])) {
                $members->where('position_id', $filter['position']);
            }
        }

        return $members->get();
    }

// Define the filter method to modify the $members query
    public function filter($query, $relation, $column, $value)
    {
        return $query->whereHas($relation, function ($query) use ($column, $value) {
            $query->where($column, $value);  // Adjusted to use $value directly
        });
    }
}
