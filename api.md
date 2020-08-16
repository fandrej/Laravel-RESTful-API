## Описание API
Пердполагаем, что имя хоста `http://laravel.loc`

### Публичные методы
Получение списка городов
```
http://laravel.loc/api/towns
```
Получение списка подразделений в конкретном городе
```
http://laravel.loc/api/towns/{town_id}/deps
```
Получение информации о юридическом лице конкретного подразделения
```
http://laravel.loc/api/deps/{dep_id}/firma
```
Аутентификация
```
curl -X POST -H 'Content-Type: application/json' -i 'http://laravel.loc/api/login' --data '{"email": "1@1.ru", "password": "11111111"}'
```
Ответ: `{"api_token":"AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i43"}`



### Методы, требующие аутентификации
Предполагаем, что токен = `AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42`

Во всех случаях действия коснутся только пользователей/подразделений/юрлиц, принадлежащих тому же юридическому лицу, что и текущий пользователь.
При попытке получить/изменить данные, принадлежащие другим юрлицам будет получен ответ `error: Not found`

#### Пользователи
Получение списка пользователей
```
http://laravel.loc/api/users?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
```
Информация о пользователе
```
http://laravel.loc/api/users/{user_id}?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
```
Добавление Пользователей
```
curl -X POST -H 'Content-Type: application/json' -i '/api/users?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42' --data '{
"name":"44",
"fio":"Добавлен Через API",
"email":"44@44.ru",
"phone":"445544",
"password":"44444444"
}'
```
изменение Пользователей
```
curl -X PUT -H 'Content-Type: application/json' -i 'http://laravel.loc/api/users/{user_id}?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42' --data '{
"name":"44",
"fio":"Добавлен Через API",
"email":"44@44.ru",
"phone":"11111111",
"password":"44444444"
}'
```
```
curl -X PATCH -H 'Content-Type: application/json' -i 'http://laravel.loc/api/users/{user_id}?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42' --data '{
"password":"22222222"
}'
```
удаление Пользователей
```
curl -X DELETE -H 'Content-Type: application/json' -i 'http://laravel.loc/api/users/{user_id}?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42'
```


#### Подразделения
Получение списка подразделений
```
http://laravel.loc/api/deps?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
```
Информация о подразделении
```
http://laravel.loc/api/deps/{dep_id}?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
```
Добавление подразделения
```
curl -X POST -H 'Content-Type: application/json' -i 'http://laravel.loc/api/deps?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42' --data '{
"name":"Добавлено Через API",
"address":"Адрес",
"type":"Кафе"
}'
```
изменение подразделения
```
curl -X PUT -H 'Content-Type: application/json' -i 'http://laravel.loc/api/deps/{dep_id}?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42' --data '{
"name":"Добавлено Через API",
"address":"Адрес 1",
"type":"Кафе"
}'
```
```
curl -X PATCH -H 'Content-Type: application/json' -i 'http://laravel.loc/api/deps/{dep_id}?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42' --data '{
"type":"Офис"
}'
```
удаление подразделения
```
curl -X DELETE -H 'Content-Type: application/json' -i 'http://laravel.loc/api/deps/{dep_id}?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42'
```

Получение списка городов подразделений
```
http://laravel.loc/api/deps/towns?api_token=AHmoXv5dzB2ZxAXiFc8LAvpjKoUBNZijwjKnuM08Wp9Dr4HPUh8NJVeO2i42
```
