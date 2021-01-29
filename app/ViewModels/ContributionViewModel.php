<?php

namespace App\ViewModels;

use App\Office;
use App\Contribution;
use Spatie\ViewModels\ViewModel;

class ContributionViewModel extends ViewModel
{
    public $indexUrl = null;
    public $edit = null;

    public function __construct(Contribution $contribution = null, $edit = false)
    {
        $this->contribution = $contribution;

        $this->indexUrl = route('contributions.index');

        $this->edit = $edit;
    }

    public function contribution()
    {
        return $this->contribution ?? new Contribution();
    }

    public function volunteers()
    {
        return auth()->user()->office->volunteers()->get();
    }

    public function selectedItems()
    {
        return $this->contribution->internalDonatedItems ?? null;
    }

    public function receiveOffices()
    {
        return Office::orderBy('id', 'desc')->where('id', '!=', auth()->user()->office_id)->get();
    }
}
