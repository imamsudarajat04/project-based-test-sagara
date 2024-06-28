<?php

namespace App\Jobs;

use App\Models\ImportLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

if (!function_exists('str_putcsv')) {
    function str_putcsv($input, $delimiter = ',', $enclosure = '"')
    {
        $fp = fopen('php://temp', 'r+');
        fputcsv($fp, $input, $delimiter, $enclosure);
        rewind($fp);
        $data = fread($fp, 1048576);
        fclose($fp);
        return rtrim($data, "\n");
    }
}

class ProcessImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $importLog;

    public function __construct(ImportLog $importLog)
    {
        $this->importLog = $importLog;
    }

    public function handle()
    {
        set_time_limit(0); // Set execution time to unlimited
        ini_set('memory_limit', '2048M'); // Increase memory limit

        $filePath = storage_path('app/' . $this->importLog->file_path);
        $failedRows = [];
        $rowsSuccess = 0;
        $rowsFailed = 0;
        $errorLog = '';

        if (($handle = fopen($filePath, 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ','); // Read the header row
            $columns = $header; // Store the column names

            $batchSize = 1000;
            $batch = [];

            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $batch[] = array_combine($columns, $data);

                if (count($batch) >= $batchSize) {
                    $this->insertBatch($batch, $rowsSuccess, $rowsFailed, $failedRows, $errorLog);
                    $batch = [];
                }
            }

            // Insert remaining rows
            if (count($batch) > 0) {
                $this->insertBatch($batch, $rowsSuccess, $rowsFailed, $failedRows, $errorLog);
            }

            fclose($handle);
        }

        if ($rowsFailed > 0) {
            $failedFilePath = 'failed_imports/failed_' . $this->importLog->id . '.csv';
            $this->createCsvFile($failedFilePath, $failedRows);
        }

        $this->importLog->update([
            'status' => 'Completed',
            'error_log' => $errorLog,
            'rows_success' => $rowsSuccess,
            'rows_failed' => $rowsFailed,
            'failed_file_path' => $failedFilePath ?? null,
        ]);

        // Send notification (implement your notification logic here)
    }

    private function insertBatch(&$batch, &$rowsSuccess, &$rowsFailed, &$failedRows, &$errorLog)
    {
        foreach ($batch as $rowData) {
            try {
                DB::table('transactions')->insert([
                    'pc' => $rowData['pc'],
                    'trx' => $rowData['trx'],
                    'tanggal_trx' => $rowData['tanggal_trx'],
                    'produk' => $rowData['produk'],
                    'qty' => $rowData['qty'],
                    'no_tujuan' => $rowData['no_tujuan'],
                    'kode_seller' => $rowData['kode_seller'],
                    'reseller' => $rowData['reseller'],
                    'modul' => $rowData['modul'],
                    'status' => $rowData['status'],
                    'tanggal_status' => $rowData['tanggal_status'],
                    'nama_supplier' => $rowData['nama_supplier'],
                    'stock' => $rowData['stock'],
                    'harga_beli' => $rowData['harga_beli'],
                    'harga_jual' => $rowData['harga_jual'],
                    'komisi' => $rowData['komisi'],
                    'laba' => $rowData['laba'],
                    'poin' => $rowData['poin'],
                    'reply_provider' => $rowData['reply_provider'],
                    'sn' => $rowData['sn'],
                    'ref_id' => $rowData['ref_id'],
                    'rate_tp' => $rowData['rate_tp'],
                    'rate' => $rowData['rate'],
                    'shell' => $rowData['shell'],
                    'hbfix' => $rowData['hbfix'],
                    'notes' => $rowData['notes'],
                    'kode_provider' => $rowData['kode_provider'],
                    'provider' => $rowData['provider'],
                    'kode_produk' => $rowData['kode_produk'],
                ]);
                $rowsSuccess++;
            } catch (\Exception $e) {
                $rowsFailed++;
                $failedRows[] = $rowData;
                $errorLog .= "Error on row " . json_encode($rowData) . ": " . $e->getMessage() . "\n";
            }
        }
    }

    private function createCsvFile($filePath, $rows)
    {
        $csvContent = '';
        foreach ($rows as $row) {
            $csvContent .= str_putcsv($row) . "\n";
        }
        Storage::put($filePath, $csvContent);
    }
}
