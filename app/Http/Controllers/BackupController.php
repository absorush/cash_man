<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BackupController extends Controller
{
    public function create()
{
    try {
        // Run backup command exactly as it works in the terminal
        $output = [];
        $returnVar = 0;
        
        // Run artisan command directly like it works in terminal
        exec('C:\xampp\php\php.exe ' . base_path('artisan') . ' backup:run', $output, $returnVar);

        // Log the output for debugging
        Log::info("Backup Output: " . implode("\n", $output));
        Log::info("Backup Exit Code: " . $returnVar);

        if ($returnVar === 0) {
            return redirect()->back()->with('success', '✅ پشتیبان‌گیری موفقانه انجام شد!');
        } else {
            return redirect()->back()->with('error', '❌ خطا در ایجاد پشتیبان. لطفاً لاگ‌ها را بررسی کنید.');
        }
    } catch (\Exception $e) {
        Log::error("Backup Error: " . $e->getMessage());
        return redirect()->back()->with('error', '❌ خطا در ایجاد پشتیبان: ' . $e->getMessage());
    }
}

public function download($file)
{
    $backupPath = storage_path("app/private/Laravel/{$file}");

    if (file_exists($backupPath)) {
        return response()->download($backupPath);
    } else {
        return redirect()->back()->with('error', '❌ فایل پشتیبان یافت نشد.');
    }
}


}

