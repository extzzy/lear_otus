# Деплой mongodb

## 

Роль разворачивает mongodb в зависимости от выбранных опций (standalone/replicaset)
Доступны версии: 4.4, 5, 6, 7


## Конфигурирование параметров

Доступные для изменения параметры через переменные среды:

| Имя переменной              |  unit  |  min  |  max  | default           | Comment |
| --------------------------- | :---:  | :---: | :---: | :---------------: | :-----: |
| var_source                  | text   | -     | -     | original          | Какой использовать репозиторий (original или custom) |
| var_mongo_ver               | text   | -     | -     | 7                 | Версия MongoDB |
| var_mongo_arch              | text   | -     | -     | standalone        | Standalone или Cluster (replicaset) |
| var_mongo_ip                | text   | -     | -     | 0.0.0.0           | Какую сеть будет слушать MongoDB |
| var_mongo_port              | text   | -     | -     | 27017             | Порт MongoDB |
| var_admin_password          | text   | -     | -     | password          | Пароль для рута |
| var_mongo_password          | text   | -     | -     | password          | Пароль админа всех баз |
| var_backup_pass             | text   | -     | -     | password          | Пароль для пользователя backup |
| var_replicaset_name         | text   | -     | -     | mongo_repl        | Название replicaset |

