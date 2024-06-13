<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReporteImportacionExport implements FromCollection, WithHeadings
{
    protected $insertedVehiclesTotal;

    /**
     * Constructor.
     *
     * @param array $insertedVehiclesTotal
     */
    public function __construct($insertedVehiclesTotal)
    {
        $this->insertedVehiclesTotal = $insertedVehiclesTotal;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        $data = [];

        // Encabezados para el reporte
        $data[] = ['Resultado de la Importación'];
        $data[] = [''];

        // Detalles de registros insertados
        if (isset($this->insertedVehiclesTotal['insertedVehicles'])) {
            $data[] = ['Registros Insertados:'];
            foreach ($this->insertedVehiclesTotal['insertedVehicles'] as $vehicle) {
                $data[] = [$vehicle];
            }
        }

        // Detalles de errores
        if (isset($this->insertedVehiclesTotal['errors'])) {
            $data[] = ['Errores:'];
            foreach ($this->insertedVehiclesTotal['errors'] as $error) {
                $data[] = [$error];
            }
        }

        return collect($data);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [];
    }
}
