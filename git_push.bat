@echo off
chcp 65001 >nul
cd /d "%~dp0"

echo Рабочая директория: %CD%

if not exist .git (
    echo Инициализация git репозитория...
    git init
)

echo Настройка удаленного репозитория...
git remote remove origin 2>nul
git remote add origin https://github.com/Rudem123/-.git

echo Проверка статуса...
git status --porcelain > temp_status.txt
set /p status=<temp_status.txt
del temp_status.txt

if not "%status%"=="" (
    echo Добавление файлов...
    git add .
    
    echo Создание коммита на русском языке...
    git log --oneline -1 >nul 2>&1
    if errorlevel 1 (
        git commit -m "Начальный коммит: добавлены все файлы проекта"
    ) else (
        git commit -m "Обновление проекта: добавлены новые файлы и изменения"
    )
    
    echo Переименование ветки в main...
    git branch -M main
    
    echo Загрузка на GitHub...
    git push -u origin main --force
    echo Готово! Проект загружен на GitHub.
) else (
    echo Нет изменений для коммита.
    echo Проверка удаленного репозитория...
    git branch -M main 2>nul
    git push -u origin main --force 2>nul
)

pause
