# Роль деплоя MongoDB

## Описание

Роль разворачивает MongoDB в зависимости от выбранных опций в режиме **standalone**(одиночный узел) или **replicaset**(кластер).
Также создаётся файл **/root/.mongoshrc.js** (0700) для быстрого подключения к БД без ввода пароля для
привилегированного пользователя в ОС. Авторизация включена по умолчанию.

Доступные версии MongoDB для деплоя:
- 4.4
- 5
- 6
- 7 (по умолчанию)

Простестировано на RHEL (RockyLinux 8,9)

## Конфигурирование параметров

Параметры для настройки роли передаются через переменные окружения или переменные в файле инвентаризации.
Доступные для изменения параметры перечислены в следующей таблице:

| Имя переменной окружения    | Имя в inventory  |  Тип  |  min  |  max  | По умолчанию   | Описание |
| --------------------------- | ---------------- | ----- | ----- | ----- | -------------- | -------- |
| var_source                  | input_source     | text  | -     | -     | dataline       | Какой использовать репозиторий (original или dataline) |
| var_db_version              | input_ver        | text  | -     | -     | 7              | Версия MongoDB (см. выше список доступных) |
| var_mongo_arch              | mongo_arch       | text  | -     | -     | standalone     | Режим работы 'standalone'(одиночный) или 'replicaset'(кластер) |
| var_mongo_ip                | mongo_net.bindIp | text  | -     | -     | 0.0.0.0        | Какую сеть будет слушать MongoDB |
| var_mongo_port              | mongo_net.port   | text  | -     | -     | 27017          | Порт MongoDB |
| var_root_password           | mongo_root_pass  | text  | -     | -     | password       | Пароль для рута |
| var_mongo_password          | mongo_admin_pass | text  | -     | -     | password       | Пароль админа всех баз |
| var_backup_pass             | mongo_backup_pass| text  | -     | -     | password       | Пароль для пользователя backup |
| var_replicaset_name         | replicaset_name  | text  | -     | -     | mongo_repl     | Название replicaset |
| var_vip_address             | vip_address      | text  | -     | -     | -              | Виртуальный IP для мастер ноды в режиме replicaset (пустое значение '' для автоматического вычисления). Если параметр не передан, то установки keepalived не происходит. |

## Пример sh скрипта с переменными окружения для запуска

```sh
export var_source="original"
export var_mongo_arch="replicaset"
export var_db_version=6
cd /opt/ansible-egonkov/ansible/
ansible-playbook playbooks/test.yml -i hosts/pg-test-cluster2
```

## Пример inventory файла

```YAML
all:
  hosts:
    cluster-test1.dbaas.service.dtln.ru:
      ansible_host: 10.215.2.41
    cluster-test2.dbaas.service.dtln.ru:
      ansible_host: 10.215.2.40
    cluster-test3.dbaas.service.dtln.ru:
      ansible_host: 10.215.2.39
  vars:
    ansible_connection: ssh
    input_source: "dataline"
    mongo_arch: "replicaset"
    import_data: true
    mongo_net:
      bindIp: "0.0.0.0"
      port: "27017"
    mongo_root_pass: password
    mongo_admin_pass: password
    input_ver: "6"
    replicaset_name: "rs0"
```

## Автор

Гонков Евгений - egonkov@dtln.ru
