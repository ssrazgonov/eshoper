# eshoper

#Избавляемся от папки web

1) создаем .htaccess  в корне, код можно посмотреть в самом файле
2) создаем .htaccess  в ```<app>/web```, код можно посмотреть в самом файле, ```<app>``` это папка приложения, её может не быть.
2) раскомментируем компонент url manager в файле ```config/web.php```
3) прописываем параметр `````'baseUrl' => ''````` в компоненте request в файле ```config/web.php```

# Перенос шаблона eshoper

1) исходник лежит в web/eshoper
2) Переносим подключения css и js в файл ```assets/AppAsset.php```
3) Подключаем необходимые функции из сохраненого шаблона ```views/layouts/_main.php```
такие как ```<?php $this->beginPage() ?> <html lang="<?= Yii::$app->language ?>"> <?php $this->head() ?>```и тд.
4) в ```config/web.php``` ставим параметр ```'language' => 'ru'```
5) Создаем новый класс asset. ```assets/LtAppAsset.php```

# Создание модели Category
1) Создаем класс Category, обьявляем hasMany
2) Создаем класс Product, обьявляем hasOne
3) Создаем таблицы, настраиваем подключение к БД

#Создаем виджет для меню категорий
1) Создаем папку components
2) Создаем класс MenuWidget