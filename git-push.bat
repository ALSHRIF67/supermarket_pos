@echo off
title Git Auto Push to GitHub
color 0A

:: ========================================
:: Git Auto Push Script for Windows
:: ========================================

echo ========================================
echo    Git Auto Push to GitHub
echo ========================================
echo.

:: Set your project path (change if needed)
set PROJECT_PATH=C:\xampp\htdocs\super

:: Go to project directory
cd /d %PROJECT_PATH%
if errorlevel 1 (
    echo ❌ Project directory not found: %PROJECT_PATH%
    pause
    exit /b
)

:: Check Git installation
git --version >nul 2>&1
if errorlevel 1 (
    echo ❌ Git is not installed or not in PATH.
    pause
    exit /b
)

:: Check if inside a Git repository
git rev-parse --git-dir >nul 2>&1
if errorlevel 1 (
    echo ❌ Not inside a Git repository.
    pause
    exit /b
)

:: Show current status
echo 📁 Current repository status:
git status -s
echo.

:: Get commit message from user
set /p commit_msg=📝 Enter commit message (or press Enter for auto message): 

if "%commit_msg%"=="" (
    :: Generate auto message with current date/time
    for /f "tokens=*" %%a in ('powershell -Command "Get-Date -Format 'yyyy-MM-dd HH:mm:ss'"') do set commit_msg=Auto-commit on %%a
    echo ✅ Using default message: %commit_msg%
)

echo.
echo [1/4] 📦 Staging all changes...
git add .
if errorlevel 1 (
    echo ❌ Failed to stage changes.
    pause
    exit /b
)

echo [2/4] 📝 Committing...
git commit -m "%commit_msg%"
if errorlevel 1 (
    echo ❌ No changes to commit or commit failed.
    pause
    exit /b
)

echo [3/4] ⬇️ Pulling latest changes (with rebase)...
git pull --rebase origin main
if errorlevel 1 (
    echo ❌ Pull failed. You may need to resolve conflicts manually.
    pause
    exit /b
)

echo [4/4] ⬆️ Pushing to remote...
git push origin main
if errorlevel 1 (
    echo ❌ Push failed.
    pause
    exit /b
)

echo.
echo ========================================
echo    ✅ Successfully pushed to GitHub!
echo ========================================
pause