<?php
// Script to remove comments from all PHP files in the theme
$directory = __DIR__;
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $filePath = $file->getPathname();
        $backupPath = $filePath . '.backup';
        
        // Skip backup files
        if (strpos($filePath, '.backup') !== false) {
            continue;
        }
        
        // Create a backup
        copy($filePath, $backupPath);
        
        // Read file content
        $content = file_get_contents($filePath);
        
        // Remove single-line comments (// and #) but not #[
        $content = preg_replace('/(?<!\"|\')(#|\/\/).*?(?=\r?\n|$)/m', '', $content);
        
        // Remove multi-line comments (/* */) but not /** */ (docblocks)
        $content = preg_replace('/\/\*(?!\*)([^*]|\*[^/])*\*\//s', '', $content);
        
        // Remove empty lines and extra whitespace
        $content = preg_replace("/^[\t ]*[\r\n]+/m", "", $content);
        $content = preg_replace("/[\r\n]{3,}/", "\n\n", $content);
        
        // Write the cleaned content back to the file
        file_put_contents($filePath, $content);
        
        echo "Processed: " . $filePath . "\n";
    }
}

echo "All PHP files have been processed. Original files have been backed up with .backup extension.\n";
