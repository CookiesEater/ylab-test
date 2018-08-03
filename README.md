## Установка

1. Запуск

    ```
    docker-compose up -d
    ```
    Подождать пока composer всё поставит...

2. Инициализация окружения

    ```
    docker-compose exec php php init --env=Production --overwrite=All
    ```

3. Применение миграций

    ```
    docker-compose exec php php yii migrate --interactive=0
    ```

4. Заполнение БД случайными данными

    ```
    docker-compose exec php php yii data/fill
    ```

## Опционально:

Очистить данные
```
docker-compose exec php php yii data/truncate
```

Заполнить конкретным количеством данных
```
docker-compose exec php php yii data/fill --categoryCount=15 --providerCount=16 --goodCount=42
```

При заполнении очистить всё сперва
```
docker-compose exec php php yii data/fill --truncate=true
```
