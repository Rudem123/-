$ErrorActionPreference = "Stop"
# Используем текущую директорию скрипта
$repoPath = Split-Path -Parent $MyInvocation.MyCommand.Path
if (-not $repoPath) {
    $repoPath = $PSScriptRoot
}
if (-not $repoPath) {
    $repoPath = Get-Location
}
Set-Location $repoPath
Write-Host "Working directory: $repoPath"

# Инициализация git репозитория если нужно
if (-not (Test-Path ".git")) {
    git init
}

# Добавление удаленного репозитория
git remote remove origin 2>$null
git remote add origin https://github.com/Rudem123/-.git

# Добавление всех файлов
git add .

# Коммит
git commit -m "Initial commit" 2>$null
if ($LASTEXITCODE -ne 0) {
    git commit -m "Update project"
}

# Пуш на GitHub
git branch -M main
git push -u origin main --force
