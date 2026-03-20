$projectPath = "C:\xampp\htdocs\super"
Set-Location $projectPath -ErrorAction Stop
if (-not (Get-Command git -ErrorAction SilentlyContinue)) {
    Write-Host "❌ Git not found." -ForegroundColor Red
    exit 1
}
$changes = git status --porcelain
if ($changes) {
    Write-Host "📦 Changes detected:" -ForegroundColor Cyan
    Write-Host $changes
    git add .
    if ($LASTEXITCODE -ne 0) { exit 1 }
    $msg = "Auto update - $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss')"
    git commit -m $msg
    if ($LASTEXITCODE -ne 0) { exit 1 }
    git push origin main
    if ($LASTEXITCODE -ne 0) { exit 1 }
    Write-Host "✅ Changes pushed successfully!" -ForegroundColor Green
} else {
    Write-Host "⚠️ No changes to push." -ForegroundColor Yellow
}
<#
.SYNOPSIS
    Auto Git Push to GitHub
.DESCRIPTION
    Adds all changes, commits with timestamp, and pushes to main branch.
.EXAMPLE
    .\auto-git.ps1
#>

$projectPath = "C:\xampp\htdocs\super"

Set-Location $projectPath -ErrorAction Stop

if (-not (Get-Command git -ErrorAction SilentlyContinue)) {
    Write-Host "❌ Git not found." -ForegroundColor Red
    exit 1
}

$changes = git status --porcelain
if ($changes) {
    Write-Host "📦 Changes detected:" -ForegroundColor Cyan
    Write-Host $changes

    git add .
    if ($LASTEXITCODE -ne 0) { exit 1 }

    $msg = "Auto update - $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss')"
    git commit -m $msg
    if ($LASTEXITCODE -ne 0) { exit 1 }

    git push origin main
    if ($LASTEXITCODE -ne 0) { exit 1 }

    Write-Host "✅ Changes pushed successfully!" -ForegroundColor Green
} else {
    Write-Host "⚠️ No changes to push." -ForegroundColor Yellow
}
