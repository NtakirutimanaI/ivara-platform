# ============================================
# MongoDB Extension Installation Script
# For PHP 8.3.24 (Thread-Safe, x64)
# ============================================

Write-Host "`n========================================" -ForegroundColor Cyan
Write-Host "MongoDB Extension Installation Script" -ForegroundColor Cyan
Write-Host "========================================`n" -ForegroundColor Cyan

# Configuration
$phpPath = "C:\Program Files\php-8.3.24"
$phpIniPath = "$phpPath\php.ini"
$extPath = "$phpPath\ext"
$dllName = "php_mongodb.dll"

# Step 1: Check if running as Administrator
Write-Host "[Step 1] Checking administrator privileges..." -ForegroundColor Yellow
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)

if (-not $isAdmin) {
    Write-Host "ERROR: This script must be run as Administrator!" -ForegroundColor Red
    Write-Host "Right-click PowerShell and select 'Run as Administrator'" -ForegroundColor Red
    Read-Host "Press Enter to exit"
    exit 1
}
Write-Host "✓ Running as Administrator`n" -ForegroundColor Green

# Step 2: Verify PHP installation
Write-Host "[Step 2] Verifying PHP installation..." -ForegroundColor Yellow
if (-not (Test-Path $phpPath)) {
    Write-Host "ERROR: PHP not found at $phpPath" -ForegroundColor Red
    Read-Host "Press Enter to exit"
    exit 1
}
Write-Host "✓ PHP found at $phpPath`n" -ForegroundColor Green

# Step 3: Check for downloaded DLL
Write-Host "[Step 3] Looking for MongoDB extension DLL..." -ForegroundColor Yellow
Write-Host "`nPlease download the file from:" -ForegroundColor Cyan
Write-Host "https://windows.php.net/downloads/pecl/releases/mongodb/`n" -ForegroundColor Cyan
Write-Host "File needed: php_mongodb-8.3-ts-x64.dll`n" -ForegroundColor Yellow

$downloadsPath = "$env:USERPROFILE\Downloads"
$possibleFiles = @(
    "$downloadsPath\php_mongodb-8.3-ts-x64.dll",
    "$downloadsPath\php_mongodb.dll",
    ".\php_mongodb-8.3-ts-x64.dll",
    ".\php_mongodb.dll"
)

$dllSource = $null
foreach ($file in $possibleFiles) {
    if (Test-Path $file) {
        $dllSource = $file
        break
    }
}

if (-not $dllSource) {
    Write-Host "DLL not found in Downloads folder or current directory." -ForegroundColor Red
    $customPath = Read-Host "Enter the full path to the DLL file (or press Enter to exit)"
    if ([string]::IsNullOrWhiteSpace($customPath)) {
        exit 1
    }
    if (Test-Path $customPath) {
        $dllSource = $customPath
    } else {
        Write-Host "ERROR: File not found at $customPath" -ForegroundColor Red
        Read-Host "Press Enter to exit"
        exit 1
    }
}

Write-Host "✓ Found DLL at: $dllSource`n" -ForegroundColor Green

# Step 4: Copy DLL to ext folder
Write-Host "[Step 4] Copying DLL to PHP ext folder..." -ForegroundColor Yellow
$dllDest = "$extPath\$dllName"

try {
    Copy-Item -Path $dllSource -Destination $dllDest -Force
    Write-Host "✓ DLL copied to $dllDest`n" -ForegroundColor Green
} catch {
    Write-Host "ERROR: Failed to copy DLL: $_" -ForegroundColor Red
    Read-Host "Press Enter to exit"
    exit 1
}

# Step 5: Update php.ini
Write-Host "[Step 5] Updating php.ini..." -ForegroundColor Yellow

if (-not (Test-Path $phpIniPath)) {
    Write-Host "ERROR: php.ini not found at $phpIniPath" -ForegroundColor Red
    Read-Host "Press Enter to exit"
    exit 1
}

# Read php.ini content
$phpIniContent = Get-Content $phpIniPath -Raw

# Check if extension is already enabled
if ($phpIniContent -match "^\s*extension\s*=\s*php_mongodb\.dll" -or $phpIniContent -match "^\s*extension\s*=\s*mongodb") {
    Write-Host "✓ MongoDB extension already enabled in php.ini`n" -ForegroundColor Green
} else {
    # Find the extensions section and add mongodb
    if ($phpIniContent -match ";extension=php_mongodb\.dll") {
        # Uncomment existing line
        $phpIniContent = $phpIniContent -replace ";extension=php_mongodb\.dll", "extension=php_mongodb.dll"
        Write-Host "✓ Uncommented existing extension line`n" -ForegroundColor Green
    } else {
        # Add new line after other extensions
        $extensionLine = "`nextension=php_mongodb.dll"
        if ($phpIniContent -match "(extension=.+?\.dll)") {
            $phpIniContent = $phpIniContent -replace "(extension=.+?\.dll)", "`$1$extensionLine"
        } else {
            $phpIniContent += $extensionLine
        }
        Write-Host "✓ Added extension line to php.ini`n" -ForegroundColor Green
    }
    
    # Backup original php.ini
    $backupPath = "$phpIniPath.backup-$(Get-Date -Format 'yyyyMMdd-HHmmss')"
    Copy-Item -Path $phpIniPath -Destination $backupPath
    Write-Host "✓ Backed up php.ini to $backupPath`n" -ForegroundColor Green
    
    # Write updated content
    try {
        Set-Content -Path $phpIniPath -Value $phpIniContent -NoNewline
        Write-Host "✓ php.ini updated successfully`n" -ForegroundColor Green
    } catch {
        Write-Host "ERROR: Failed to update php.ini: $_" -ForegroundColor Red
        Read-Host "Press Enter to exit"
        exit 1
    }
}

# Step 6: Verify installation
Write-Host "[Step 6] Verifying installation..." -ForegroundColor Yellow
$verification = php -m | Select-String "mongodb"

if ($verification) {
    Write-Host "✓ MongoDB extension is loaded!`n" -ForegroundColor Green
    Write-Host "========================================" -ForegroundColor Cyan
    Write-Host "INSTALLATION SUCCESSFUL!" -ForegroundColor Green
    Write-Host "========================================`n" -ForegroundColor Cyan
} else {
    Write-Host "⚠ Extension not loaded yet. You may need to restart your terminal.`n" -ForegroundColor Yellow
    Write-Host "Run this command to verify: php -m | findstr mongodb`n" -ForegroundColor Yellow
}

Write-Host "Next steps:" -ForegroundColor Cyan
Write-Host "1. Close and reopen your terminal/PowerShell" -ForegroundColor White
Write-Host "2. Run: php -m | findstr mongodb" -ForegroundColor White
Write-Host "3. You should see 'mongodb' in the output`n" -ForegroundColor White

Read-Host "Press Enter to exit"
