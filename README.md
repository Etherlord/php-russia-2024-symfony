# PHP Russia 2024. Symfony

Это демо приложение, демонстрирующее как можно настроить Symfony для соблюдения принципов 12 factor app.

### Requirements

1. Утилита `mkcert` (https://github.com/FiloSottile/mkcert)  
2. Утилита `make` (Поставляется в большинстве linux дистрибутивов, но не всегда установлена по умолчанию)
3. `docker` + `docker compose plugin` (https://docs.docker.com/engine/install/)  

Приложение тестировалось и гарантированно будет работать под linux. Под MacOS и Windows не тестировалось

### Init

Для первоначальной настройки приложения требуется запустить команду `make init`  
Для запуска `make up`  
Для остановки `make down`

### Features  

Все примеры запросов сделаны с помощью HTTP Request в PhpStorm

1. Аутентификация на основе JWT.   
Тут нет никакой полезной нагрузки, никаких проверок логина и пароля, refresh токенов, инвалидации и другого.  
Просто маленькое демо, как можно начать с этим работать. 
Для получения токена достаточно выполнить следующий запрос:
   ```
   POST https://api.php-russia-2024-symfony.local/api/v1/authenticate
   Content-Type: application/json
   ```

2. Отсылка простого сообщения фоновому процессу. Реализовано с помощью RoadRunner Jobs (https://docs.roadrunner.dev/docs/queues-and-jobs/overview-queues)  
Отсылаем сообщение фоновому процессу:
   ```
   POST https://api.php-russia-2024-symfony.local/api/v1/send-task-to-consumer
   Content-Type: application/json
   Authorization: Bearer токен, полученный от эндпоинта аутентификации

   {
       "message": "TEST"
   }
   ```
   
   В логе приложения видим, что сообщение пришло и обработалось

   ```
   app.INFO: PONG = TEST [] []
   ```
   
   При разработке лог содержится в файле `var/log/dev.log`  
   В `prod` режиме вывод будет в логах контейнера `php-daemon`


3. В приложениях, которые запускаются в нескольких экземплярах на разных серверах файлы обычно загружаются во внешнее хранилище по протоколу S3.    
   Данная фича демонстрирует как это примерно может выглядеть.  
   Загружаем файл:
   ```
   POST https://api.php-russia-2024-symfony.local/api/v1/upload-file
   Content-Type: multipart/form-data; boundary=WebAppBoundary
   Authorization: Bearer токен, полученный от эндпоинта аутентификации

   --WebAppBoundary
   Content-Disposition: form-data; name="file"; filename="test.xlsx"
   Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet

   < /home/user/test.xlsx
   --WebAppBoundary--
   ```

   В ответ получаем ссылку на скачивание файла из S3 хранилища

4. Welcome. Отображает Welcome сообщение из переменной окружения

   ```
   GET https://api.php-russia-2024-symfony.local/api/v1/welcome
   ```
   
### Deploy   

В файле `.gitlab-ci.yml` приведен пример простого деплоя приложения на условный "прод"  
В Gitlab должны быть установлены следующие переменные окружения:  
`JWT_PASSPHRASE`  
`JWT_PUBLIC_KEY` - тип `File`  
`JWT_SECRET_KEY` - тип `File`  
`WELCOME_MESSAGE`  
В докере поднимаются только контейнеры приложения. Подразумевается, что трафик на них проксируется каким-либо образом на контейнер `php` - слушает `127.0.0.1:8088` на хост машине  
Также подразумевается, что на "проде" уже используется внешний S3 сервис