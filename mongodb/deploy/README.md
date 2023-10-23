# Деплой MongoDB

Роль разворачивает mongodb в зависимости от выбранных опций (standalone/replicaset)  
Импортирует тестовые данные ( https://github.com/neelabalan/mongodb-sample-dataset/tree/main )  
Создаёт индекс в бд sample_airbnb на коллекции listingsAndReviews с именем myindex по полю year  
Также создаётся файлик /root/.mongoshrc.js (0700) для быстрого подключения к монго без ввода пароля.  
Авторизация включена поумолчанию.  
Доступны версии: 4.4, 5, 6, 7  

Простестировано на RHEL (RockyLinux 8,9)

# Удаление/создание индекса и вывод статистики до/после
    mongosh
    use simple_airbmb
    db.getCollection('listingsAndReviews').getIndexes()             // проверяем список индексов
    db.getCollection('listingsAndReviews').dropIndex('myindex')     // удаляем индекс созданный ansible
    db.getCollection('listingsAndReviews').find({year: 2000}).explain('executionStats').executionStats.executionTimeMillis // выводим статистику по поиску
    db.getCollection('listingsAndReviews').createIndex({year: -1}) // создаём индекс по year 
    db.getCollection('listingsAndReviews').find({year: 2000}).explain('executionStats').executionStats.executionTimeMillis // повторно выполняем запрос для сравнения 

# Результаты

| Номер запуска              |  Без индексом (мс)  |  С индексом (мс)  |
| -------------------------- | :----------------:  | :---------------: | 
| 1                          | 539                 | 1                 | 
| 2                          | 15                  | 1                 | 
| 3                          | 17                  | 2                 | 

# Выборка и обновление данных
    mongosh
    use simple_airbnb
    db.getCollection("listingsAndReviews").find({"weekly_price" : {"$gte" : 600,"$lt": 650}}); // вывести объявление с ценой за неделю от 600 до 650
    db.getCollection("listingsAndReviews").aggregate([{$group: {"_id": null, average_cost_week: {$avg: "$weekly_price"} } }]) // средняя цена по всем объявлениям за неделю
    db.getCollection("listingsAndReviews").updateOne(
        {"_id" : "10423504"},
        { $set: { security_deposit: "500"} }
    ); // обновление security депозита у конкретного объявления 



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

