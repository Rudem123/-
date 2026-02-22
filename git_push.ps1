# Скрипт для загрузки на GitHub
$ErrorActionPreference = "Continue"

# Используем директорию, где находится скрипт
$scriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
if (-not $scriptDir) {
    $scriptDir = $PSScriptRoot
}
Set-Location $scriptDir

Write-Host "Рабочая директория: $scriptDir"

# Инициализация git если нужно
if (-not (Test-Path ".git")) {
    Write-Host "Инициализация git репозитория..."
    git init
}

# Настройка удаленного репозитория
Write-Host "Настройка удаленного репозитория..."
git remote remove origin 2>$null
git remote add origin https://github.com/Rudem123/-.git

# Проверка статуса
Write-Host "Проверка статуса..."
$status = git status --porcelain

if ($status) {
    Write-Host "Добавление файлов..."
    git add .
    
    Write-Host "Создание коммита на русском языке..."
    $hasCommits = git log --oneline -1 2>$null
    if ($hasCommits) {
        git commit -m "Обновление проекта: добавлены новые файлы и изменения"
    } else {
        git commit -m "Начальный коммит: добавлены все файлы проекта"
    }
    
    Write-Host "Переименование ветки в main..."
    git branch -M main
    
    Write-Host "Загрузка на GitHub..."
    git push -u origin main --force
    Write-Host "Готово! Проект загружен на GitHub."
} else {
    Write-Host "Нет изменений для коммита."
    Write-Host "Проверка удаленного репозитория..."
    git branch -M main 2>$null
    git push -u origin main --force 2>$null
}
