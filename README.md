# Выполненное тестовое задание 

Результатом выполнения данного тестового задания стала таблица зарегистрированных людей **t_registered_individuals** со столбцами id, name, email, territory (находится в файле **base.sql** вместе с таблицей **t_koatuu_tree**). 

Файл соединения app/components/db_connection.php

Таблица получена путем заполнения данамически-формируемой формы с полями: ФИО, EMAIL, Список областей, Список городов, Список районов. 

Предусловие,что все поля в форме обязательны к заполнению выполнено частично (Решил обыграть города со специальным статусом).

   - [x] Динамически-формируемая форма
   - [x] Предусмотрена валидация полей на JQuery
   - [x] Для select'ов был использован плагин Chosen
   - [x] Исходная таблица **t_koatuu_tree** не изменена
   - [x] При регистрации под тем же email выдается карточка пользователя с данными из базы
   



  

