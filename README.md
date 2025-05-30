# README.md

## Шаги установки и запуска

1. **Создать файл окружения `.env`**
   ```bash
   cp .env.example .env
   ````

    ```bash
   cp src/.env.example src/.env
   ```
   
2. **Собрать проект**
   ```bash
   make build && make up
   ```
   
3. **Заходим в PHPMyAdmin и импортируем БД из database/init.sql** http://localhost:8181/