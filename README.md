# andata-test-task

В данном репозитории представлено решение тестового задания для компании Андата

Задание:

Решение:
  Для того, чтобы развернуть проект на локальной машине, необходимо:
  1. Установленная ОС Linux
  2. Установленный docker compose

  Пошаговая инструкция:
  1. Склонировать текущий репозиторий
  2. Перейти в папку с проектом andata-test-task
  3. Создать переменную окружения .env из копии файла .env.example командой: cp ./backend/.env.example ./backend/.env
  4. Собрать приложение командой: cd backend && docker compose build && docker compose up
  5. Импортировать дамп БД в контейнер mysql командой: cd backend/mysql/dumps && docker exec -i andata-blog-mysql mysql -uroot -ppassword andata_blog < andata_blog_13-06-2024.sql
  6. Открыть браузер и перейти на вкладку с url: http://localhost
  7. Попробовать по создавать статьи и комментарии к ним
