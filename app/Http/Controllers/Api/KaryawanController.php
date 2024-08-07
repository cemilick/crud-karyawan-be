<?php

namespace App\Http\Controllers\Api;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends BaseCrudController
{
    protected $class = Karyawan::class;

    public function statistics(Request $request)
    {
        $division = $request->input('division');

        $data = Karyawan::select('name');
        $isActive = Karyawan::selectRaw('*')->where('is_active', 1);
        $isNonActive = Karyawan::selectRaw('*')->where('is_active', 0);

        if ($division) {
            $isActive->where('division_id', $division);
            $isNonActive->where('division_id', $division);
            $data->where('division_id', $division);
        }

        $isActive = $isActive->get()->count();
        $isNonActive = $isNonActive->get()->count();
        $data = $data->get();

        return $this->sendResponse([
            'total_karyawan' => $isActive + $isNonActive,
            'total_karyawan_active' => $isActive,
            'total_karyawan_non_active' => $isNonActive,
            'data' => $data
        ], 'Data return successfully.');
    }
}
