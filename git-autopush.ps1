# ==============================
# Git Auto Push Script (Mac - PowerShell)
# ==============================

# Go to your project folder
Set-Location "C:\xampp\htdocs\super"

Write-Host "🔄 Starting Git Auto Push..." -ForegroundColor Cyan

# Check status
git status

# Add all changes
git add .

# Auto commit message with date
$commitMessage = "Auto update - $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss')"

# Commit
git commit -m "$commitMessage"

# Push to GitHub
git push origin main

Write-Host "✅ Code pushed successfully!" -ForegroundColor Green