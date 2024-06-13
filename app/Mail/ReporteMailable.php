<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteImportacionExport;

class ReporteMailable extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $totalRows;
    public $success;
    public $errors;
    public $insertedVehicles;

    /**
     * Create a new message instance.
     *
     * @param int $totalRows
     * @param bool $success
     * @param array $errors
     * @param array $insertedVehicles
     */
    public function __construct($totalRows, $success, $errors, $insertedVehicles)
    {
        $this->totalRows = $totalRows;
        $this->success = $success;
        $this->errors = $errors;
        $this->insertedVehicles = $insertedVehicles;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $message = $this->success ? 'Importación completada correctamente.' : 'Hubo errores durante la importación.';

        $mail = $this->view('email.reporte')
            ->subject('Reporte de Importación')
            ->with([
                'message' => $message,
                'totalRows' => $this->totalRows,
                'errors' => $this->errors,
                'insertedVehicles' => $this->insertedVehicles,


            ]);

        // Generar el archivo Excel en memoria y adjuntarlo al correo
        // $excel = Excel::raw(new ReporteImportacionExport($this->insertedVehicles), \Maatwebsite\Excel\Excel::XLSX);

        // $mail->attachData($excel, 'reporte_importacion.xlsx', [
        //     'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        // ]);

        if (!empty($this->errors)) {
            $mail->attachData(implode("\n", $this->errors), 'errores.txt');
        }

        return $mail;
    }
}
