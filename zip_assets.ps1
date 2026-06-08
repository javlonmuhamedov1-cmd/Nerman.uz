$sourceDir = "c:\Users\user\Desktop\Nerman_NEW_disegn\static"
$outputPrefix = "c:\Users\user\Desktop\Nerman_NEW_disegn\Nerman_Assets_Part"
$maxSizeMB = 950 # Slightly less than 990 to be safe
$maxSizeBytes = $maxSizeMB * 1024 * 1024

$files = Get-ChildItem -Path $sourceDir -Recurse -File | Select-Object FullName, Length

$currentPart = 1
$currentSize = 0
$currentFiles = New-Object System.Collections.Generic.List[string]

foreach ($file in $files) {
    if ($currentSize + $file.Length -gt $maxSizeBytes -and $currentFiles.Count -gt 0) {
        # Zip current batch
        $zipPath = "$outputPrefix$currentPart.zip"
        Write-Host "Creating $zipPath..."
        
        # We need to preserve relative paths, so we use a temporary staging area or relative paths
        $tempDir = New-Item -ItemType Directory -Path "$env:TEMP\NermanTempPart$currentPart" -Force
        foreach ($f in $currentFiles) {
            $relPath = $f.Replace($sourceDir, "")
            $destPath = Join-Path $tempDir.FullName $relPath
            $destFolder = Split-Path $destPath
            if (!(Test-Path $destFolder)) { New-Item -ItemType Directory -Path $destFolder -Force }
            Copy-Item $f -Destination $destPath
        }
        
        Compress-Archive -Path "$($tempDir.FullName)\*" -DestinationPath $zipPath -Force
        Remove-Item -Path $tempDir -Recurse -Force
        
        $currentPart++
        $currentSize = 0
        $currentFiles.Clear()
    }
    
    $currentFiles.Add($file.FullName)
    $currentSize += $file.Length
}

# Zip remaining files
if ($currentFiles.Count -gt 0) {
    $zipPath = "$outputPrefix$currentPart.zip"
    Write-Host "Creating final $zipPath..."
    $tempDir = New-Item -ItemType Directory -Path "$env:TEMP\NermanTempPart$currentPart" -Force
    foreach ($f in $currentFiles) {
        $relPath = $f.Replace($sourceDir, "")
        $destPath = Join-Path $tempDir.FullName $relPath
        $destFolder = Split-Path $destPath
        if (!(Test-Path $destFolder)) { New-Item -ItemType Directory -Path $destFolder -Force }
        Copy-Item $f -Destination $destPath
    }
    Compress-Archive -Path "$($tempDir.FullName)\*" -DestinationPath $zipPath -Force
    Remove-Item -Path $tempDir -Recurse -Force
}

Write-Host "Successfully created $currentPart parts."
