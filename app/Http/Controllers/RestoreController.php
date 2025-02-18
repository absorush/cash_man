<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class RestoreController extends Controller
{

 

    public function index()
{
    // ✅ Get backup files using PHP (NOT Laravel Storage)
    $backupPath = storage_path('app/private/Laravel');
    $backups = glob("$backupPath/*.zip");

    // ✅ Check if backups exist
    if (empty($backups)) {
        return view('restore.index')->with('error', 'هیچ فایل پشتیبانی موجود نیست.');
    }

    // ✅ Sort backups by last modified time (LATEST FIRST)
    usort($backups, function ($a, $b) {
        return filemtime($b) - filemtime($a);
    });

    // ✅ Extract file names from full paths
    $backupFiles = array_map('basename', $backups);

    return view('restore.index', compact('backupFiles'));
}

  

    
public function restore(Request $request)
{
    Log::info("🔄 Restore function started...");

    // ✅ Get user-selected backup file
    $selectedBackup = $request->input('backup_file');

    if (!$selectedBackup) {
        Log::error("❌ No backup file selected by user!");
        return redirect()->back()->with('error', 'لطفاً یک فایل پشتیبان انتخاب کنید.');
    }

    $backupPath = storage_path("app/private/Laravel/$selectedBackup");

    if (!file_exists($backupPath)) {
        Log::error("❌ Selected backup file not found: " . $backupPath);
        return redirect()->back()->with('error', 'فایل پشتیبان یافت نشد.');
    }

    Log::info("📂 Selected Backup: " . $backupPath);

    // ✅ Extract Backup
    $extractPath = storage_path("app/private/temp-restore");
    Storage::deleteDirectory('private/temp-restore');
    Storage::makeDirectory('private/temp-restore');

    $zip = new \ZipArchive;
    if ($zip->open($backupPath) === TRUE) {
        $zip->extractTo($extractPath);
        $zip->close();
        Log::info("✅ Backup extracted to: " . $extractPath);
    } else {
        Log::error("❌ Failed to extract backup!");
        return redirect()->back()->with('error', 'استخراج فایل پشتیبان ناکام شد.');
    }

    // ✅ Find the database dump file
    Log::info("🔍 Checking for .sql files in: " . $extractPath . '/db-dumps');
    $sqlFiles = glob("$extractPath/db-dumps/*.sql");

    if (empty($sqlFiles)) {
        Log::error("❌ No database dump file found!");
        return redirect()->back()->with('error', 'هیچ فایل دیتابیسی در پشتیبان یافت نشد.');
    }

    $sqlFile = str_replace('/', '\\', $sqlFiles[0]);
    Log::info("✅ Database dump file found: " . $sqlFile);

    // ✅ MySQL Restore Command
    $mysqlPath = "C:\\xampp\\mysql\\bin\\mysql.exe";

    if (!file_exists($mysqlPath)) {
        Log::error("❌ MySQL executable not found at: " . $mysqlPath);
        return redirect()->back()->with('error', 'MySQL مسیر پیدا نشد.');
    }

    $command = "\"{$mysqlPath}\" --default-character-set=utf8mb4 -u root  cash_management < \"{$sqlFile}\"";

    Log::info("🛠 Running MySQL restore command: " . $command);

    exec($command . ' 2>&1', $output, $returnVar);

    if ($returnVar !== 0) {
        Log::error("❌ Database restore failed! Output: " . implode("\n", $output));
        return redirect()->back()->with('error', 'بازیابی دیتابیس ناکام شد! خطا در لاگ را بررسی کنید.');
    }

    Log::info("✅ Database restore successful!");
    return redirect()->back()->with('success', 'بازیابی دیتابیس موفقانه انجام شد!');
}





   





}
