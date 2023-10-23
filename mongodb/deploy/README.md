# Деплой MongoDB

Роль разворачивает mongodb в зависимости от выбранных опций (standalone/replicaset)  
Импортирует тестовые данные ( https://github.com/neelabalan/mongodb-sample-dataset/tree/main )  
Создаёт индекс в бд sample_airbnb на коллекции listingsAndReviews с именем myindex по полю year  
Также создаётся файлик /root/.mongoshrc.js (0700) для быстрого подключения к монго без ввода пароля.  
Авторизация включена поумолчанию.  
Доступны версии: 4.4, 5, 6, 7  

Простестировано на RHEL (RockyLinux 8,9)

## Пример sh скрипта с переменными окружения для запуска
    export var_source="original"
    export var_mongo_arch="replicaset"
    export var_mongo_ver=6
    cd /opt/ansible-egonkov/ansible/
    ansible-playbook simple_playbook.yml -i simple_inventory


## Конфигурирование параметров

Доступные для изменения параметры через переменные среды:

| Имя переменной              |  unit  |  min  |  max  | default           | Comment |
| --------------------------- | :---:  | :---: | :---: | :---------------: | :-----: |
| var_source                  | text   | -     | -     | original          | Какой использовать репозиторий (original или custom) |
| var_db_version              | text   | -     | -     | 7                 | Версия MongoDB |
| var_mongo_arch              | text   | -     | -     | standalone        | Standalone или Cluster (replicaset) |
| var_mongo_ip                | text   | -     | -     | 0.0.0.0           | Какую сеть будет слушать MongoDB |
| var_mongo_port              | text   | -     | -     | 27017             | Порт MongoDB |
| var_admin_password          | text   | -     | -     | password          | Пароль для рута |
| var_mongo_password          | text   | -     | -     | password          | Пароль админа всех баз |
| var_backup_pass             | text   | -     | -     | password          | Пароль для пользователя backup |
| var_replicaset_name         | text   | -     | -     | mongo_repl        | Название replicaset |
| var_import                  | text   | -     | -     | true              | Загрузить тестовые данные? |

