@echo off
chcp 65001 >nul
cd /d "C:\учеба\РУП\Серверная веб-разработка\Домашнее задание 1\Rudem"

if not exist .git (
    git init
)

git remote remove origin 2>nul
git remote add origin https://github.com/Rudem123/-.git

git add .

git commit -m "Initial commit" 2>nul
if errorlevel 1 (
    git commit -m "Update project"
)

git branch -M main
git push -u origin main --force

pause
