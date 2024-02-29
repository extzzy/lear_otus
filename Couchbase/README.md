## Couchbase
1. Развернуть кластер Couchbase 
2. Создать БД, наполнить небольшими тестовыми данными 
3. Проверить отказоустойчивость 


### Развернуть кластер Couchbase
1. Деплой кластера происходит посредством запуска плебука 

```Bash
ansible-playbook otus_playbook.yml -i otus_inventory.yml 
```

### Создать БД, наполнить небольшими тестовыми данными 
1. Подключиться к кластеру по порту ip:port http://ip:8091 
2. Перейти на вкладку Settings - Sample Buckets и выбрать все датасеты
3. Нажать Load Sample Data

### Проверить отказоустойчивость 
1. Перейти на вкладку Query и вывести количество строк в бакете travelSample
```SQL
SELECT COUNT(*) FROM travelSample
```

```Json
[
  {
    "code": 12003,
    "msg": "Keyspace not found in CB datastore: default:travelSample - cause: No bucket named travelSample",
    "query": "SELECT COUNT(*) FROM travelSample"
  }
]
```
2. Отправить 3 ноду кластера в оффлайн (shutdown)
3. Проверить повторно сколько записей доступно
```SQL
SELECT COUNT(*) FROM travelSample
```

```Json
[
  {
    "code": 12003,
    "msg": "Keyspace not found in CB datastore: default:travelSample - cause: No bucket named travelSample",
    "query": "SELECT COUNT(*) FROM travelSample"
  }
]
```