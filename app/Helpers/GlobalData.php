<?php

use \Illuminate\Database\Eloquent\Collection;
use App\Models\Section;
use App\Models\Committee;
use App\Models\Position;

/**
 * Get All Sections
 *
 * @return Collection
 */
function getSections(): Collection
{
    return Section::get();
}

function getSectionsArray(): Array
{
    $sections = [];
    foreach (getSections() as $section){
        $sections[$section['name']] = $section['id'];
    }
    return $sections;
}

/**
 * Get All Committees
 *
 * @return Collection
 */
function getCommittees(): Collection
{
    return Committee::get();
}


function getCommitteesArray(): Array
{
    $committees = [];
    foreach (getCommittees() as $committee){
        $committees[$committee['name']] = $committee['id'];
    }
    return $committees;
}
/**
 * Get All Positions
 *
 * @return Collection
 */
function getPositions(): Collection
{
    return Position::get();
}

function getPositionsArray(): Array
{
    $positions = [];
    foreach (getPositions() as $position){
        $positions[$position['name']] = $position['id'];
    }
    return $positions;
}
