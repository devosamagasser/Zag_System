<?php

namespace App\Traits;
use RealRashid\SweetAlert\Facades\Alert;

Trait MainTrait
{
    public function mainData($pageTitle)
    {
        return [
            'section' => $this->section,
            'pageTitle' => $pageTitle,
        ];
    }

    public function backHome($message)
    {
        Alert::success('Done', $message);
        return redirect(route($this->section.'.index'));
    }
}
