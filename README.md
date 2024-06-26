# andata-test-task

В данном репозитории представлено решение тестового задания для компании "Андата"

<h6>Задание:</h6>

<details> 
  <summary>Необходимо разработать SPA веб-сайт с простой системой комментирования</summary>
  <ul>
    <li>Шаблон страницы должен содержать блоки header и footer</li>
    <li>В блоке header должен быть размещен логотип компании и текстовый заголовок страницы</li>
    <li>В блоке footer должны размещаться кликабельные иконки соцсетей</li>
    <li>В теле страницы должны присутствовать:
      <ul>
        <li>Оформленный блок со статьей-рыбой Lorem Ipsum или любой другой объемом в два абзаца</li>
        <li>Блок добавления нового комментария, содержащий следующие поля:
          <ul>
            <li>Имя пользователя</li>
            <li>Email</li>
            <li>Заголовок комментария</li>
            <li>Текст комментария</li>
          </ul>
        </li>
      </ul>
    </li>
  </ul>
  <ul>
    <li>Предъявляемые требования к системе комментирования:
      <ul>
        <li>Комментарии должны храниться в БД, совместимой с MySQL</li>
        <li>Комментарии должны валидироваться и на фронтенде, и на бекенде</li>
        <li>Добавление нового комментария должно происходить асинхронно, без перезагрузки страницы</li>
        <li>Блок с историей комментариев. В истории комментариев должны отображаться все поля, используемые при добавлении комментария, а также дата добавления комментария</li>
      </ul>
    </li>
  </ul>
</details>

<details>
  <summary>Требования к выполнению задания</summary>
  <ul>
    <li>Нельзя использовать фреймворки, определяющие общую архитектуру веб-приложения (Laravel, Symfony, Yii и другие), приложение должно быть реализовано на нативном PHP версии не ниже 8.0</li>
    <li>Нельзя использовать готовый шаблон верстки</li>
    <li>Разработанное приложение должно использовать паттерн MVC</li>
    <li>Допускается использование PHP и JS библиотек</li>
    <li>Код, написанный на языке PHP, должен быть оформлен в соотетствии с последним актуальным стандартом оформления кода PSR</li>
    <li>Используемые и реализуемые сущности должны соответствовать стандартам PSR, если таковые имеются для предметной области</li>
    <li>Все свойства и методы должны быть типизированы, при этом не должно возникать ошибок типизации. Там, где невозможно определить типы конструкциями языка, должны использоваться подсказки в док-блоках (@var, @param и @return)</li>
    <li>Приложение должно выполняться в Docker-среде</li>
    <li>Приложение должно быть передано в виде ссылки на Git-репозиторий на любом общедоступном хостинге, не требующем обязательной авторизации для просмотра и клонирования репозитория</li>
    <li>В репозитории с приложением должен находиться файл README.md, содержащий описание приложения, примечания и инструкцию по запуску приложения</li>
  </ul>
</details>

<h6>Решение:</h6>

<details>
  <summary>Требования к локальной машине</summary>
  <ol>
    <li>Установленная ОС Linux</li>
    <li>Установленный docker compose</li>
  </ol>
</details>

<details>
  <summary>Пошаговая инструкция</summary>
  <ol>
    <li>Склонировать текущий репозиторий</li>
    <li>Открыть в IDE папку с проектом andata-test-task</li>
    <li>Открыть терминал</li>
    <li>Перейти в папку backend командой:
      <br>
      <code>
        cd backend
      </code>
    </li>
    <li>Создать переменную окружения .env из копии файла .env.example командой:
      <br>
      <code>
        cp .env.example .env
      </code>
    </li>
    <li>Собрать приложение командой:
      <br>
      <code>
        docker compose build && docker compose up
      </code>
    </li>
    <li>Установить зависимости для php командой:
      <br>
      <code>
        docker exec -i andata-blog-backend composer install
      </code>
    </li>
    <li>Импортировать дамп БД в контейнер mysql командой:
      <br>
      <code>
        cd mysql/dumps && docker exec -i andata-blog-mysql mysql -uroot -ppassword andata_blog < andata_blog_13-06-2024.sql
      </code>
    </li>
    <li>Открыть браузер и перейти на вкладку с url: <a href="http://localhost">http://localhost</a></li>
    <li>В списке, блога будет три статьи. Можно попробовать посоздавать статьи и комментарии к ним</li>
  </ol>
</details>

<details>
  <summary>Для запуска e2e тестов</summary>
  <ol>
    <li>Необходимо иметь установленный менеджер пакетов npm</li>
    <li>Перейти в папку frontend командой:
      <br>
      <code>
        cd frontend
      </code>
    </li>
    <li>Временно установить расширение для Playwright - браузер Chromium. В нем мы и будем запускать наши тесты:
      <br>
      <code>
        npx playwright install chromium
      </code>
    </li>
    <li>Запустить e2e тесты командой:
      <br>
      <code>
        npx playwright test
      </code>
    </li>
  </ol>
</details>
