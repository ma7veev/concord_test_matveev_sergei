# concord_test_matveev_sergei
Требования к окружению:
PHP >= 7.1
MySQL >= 5.7

Установка:

1)Для корректной работы проекта YII2, его нужно инициализировать консольной командой php init, выбрав development режим. Важно не перезаписать файлы с локальными настройками

2)composer install

3)После указать host, username, password в настройках бд в файле "\common\config\main-local.php". По умолчанию указаны 'localhost', 'root', ''. Сделать это для обоих подключений 'preinstallDb', 'db'

4)Теперь можно мигрировать yii migrate. Миграция создаст как саму БД, так и таблицы

5)Я вынес папку web в корень и определил в ней document root. Поэтому консольная команда для запуска YII сервера: yii serve --docroot="web"

Описание:

Данные для аутентификации: 
login: admin
pass: admin123

На главной странице "/" - ссылки на страницы создания и удаления.

Удалить или изменить пользователя, можно, нажав на соответвующую кнопку на странице "/users/index/".

Сортировка осуществляется по клику по соответствующему полю в шапке таблицы
в "/users/index/". Это pjax сортировка.

Когда к-во юзеров/групп превысит 5, включится пагинация

Директория для фото - "/web/uploads/users_photo/".




