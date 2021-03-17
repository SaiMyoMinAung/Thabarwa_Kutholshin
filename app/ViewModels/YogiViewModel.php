<?php

namespace App\ViewModels;

use App\Ward;
use App\Yogi;
use Spatie\ViewModels\ViewModel;
use Illuminate\Database\Eloquent\Collection;

class YogiViewModel extends ViewModel
{
    public $edit = null;

    public function __construct(Yogi $yogi = null, $edit = false)
    {
        $this->yogi = $yogi;

        $this->edit = $edit;
    }

    public function yogi(): Yogi
    {
        return $this->yogi ?? new Yogi();
    }

    public function wards(): Collection
    {
        return Ward::withTrashed()->with('center')->get();
    }
}
