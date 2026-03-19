#!/usr/bin/env pwsh
<#
.SYNOPSIS
    Automates git add, commit, and push to GitHub.
.DESCRIPTION
    This script stages all changes, commits with a provided or auto-generated message,
    pulls any remote changes (with rebase), and pushes to the current branch.
.PARAMETER Message
    Optional commit message. If not provided, a default message with date/time is used.
.PARAMETER NoPull
    Skip pulling before push.
.EXAMPLE
    ./git-autopush.ps1 -Message "Fix bug in POS module"
.EXAMPLE
    ./git-autopush.ps1
#>

param(
    [string]$Message = "",
    [switch]$NoPull
)

# Function to check if we are in a git repository
function Test-GitRepository {
    git rev-parse --git-dir > $null 2>&1
    return $?
}

# Function to check for changes
function Test-Changes {
    $status = git status --porcelain
    return [string]::IsNullOrEmpty($status) -eq $false
}

# Main script
Write-Host "🚀 Starting GitHub update automation..." -ForegroundColor Cyan

# Check if we are in a git repo
if (-not (Test-GitRepository)) {
    Write-Host "❌ Not inside a Git repository. Exiting." -ForegroundColor Red
    exit 1
}

# Check for changes
if (-not (Test-Changes)) {
    Write-Host "✅ No changes to commit. Exiting." -ForegroundColor Green
    exit 0
}

# Prepare commit message
if ([string]::IsNullOrWhiteSpace($Message)) {
    $date = Get-Date -Format "yyyy-MM-dd HH:mm:ss"
    $Message = "Auto-commit on $date"
    Write-Host "ℹ️ No commit message provided. Using: '$Message'" -ForegroundColor Yellow
}

# Add all changes
Write-Host "📦 Staging all changes..." -ForegroundColor Cyan
git add .
if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ Failed to stage changes." -ForegroundColor Red
    exit 1
}

# Commit
Write-Host "📝 Committing with message: '$Message'" -ForegroundColor Cyan
git commit -m "$Message"
if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ Commit failed." -ForegroundColor Red
    exit 1
}

# Pull if not skipped
if (-not $NoPull) {
    Write-Host "⬇️ Pulling latest changes (with rebase)..." -ForegroundColor Cyan
    git pull --rebase
    if ($LASTEXITCODE -ne 0) {
        Write-Host "❌ Pull failed. You may need to resolve conflicts manually." -ForegroundColor Red
        exit 1
    }
}

# Push
Write-Host "⬆️ Pushing to remote..." -ForegroundColor Cyan
git push
if ($LASTEXITCODE -ne 0) {
    Write-Host "❌ Push failed." -ForegroundColor Red
    exit 1
}

Write-Host "✅ Successfully updated GitHub repository!" -ForegroundColor Green