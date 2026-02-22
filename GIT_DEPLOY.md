# Инструкция по загрузке на GitHub

Выполните следующие команды в терминале PowerShell или CMD:

```bash
# Перейдите в директорию проекта
cd "C:\учеба\РУП\Серверная веб-разработка\Домашнее задание 1\Rudem"

# Инициализируйте git репозиторий (если еще не инициализирован)
git init

# Добавьте удаленный репозиторий
git remote remove origin
git remote add origin https://github.com/Rudem123/-.git

# Добавьте все файлы
git add .

# Сделайте коммит
git commit -m "Initial commit"

# Переименуйте ветку в main (если нужно)
git branch -M main

# Загрузите на GitHub
git push -u origin main --force
```

Если возникнут проблемы с аутентификацией, используйте Personal Access Token вместо пароля.
