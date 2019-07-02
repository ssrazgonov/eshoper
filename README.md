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
3) Получаем категории как массив, применяя функцию indexBy()
4) остальной код см. в классе MenuWidget
5) Кешируем, настройки кешированя в файле web.php,
``'cache' => [
               'class' => 'yii\caching\FileCache',
           ],
``
6) Используем кеш
    ``$menu = Yii::$app->cache->get('menu')``
    
    ``Yii::$app->cache->set('menu', $this->menuHtml, 60);``
##Вывод товар в категории

7) Вывод хитов
    1.  выбор хитов `$hits = Product::find()->where(['hit' => '1'])->limit(6)->all();`
    2.  Картинка для хита
    ``<?= \yii\helpers\Html::img('@web/images/home/sale.png', [``
## Постраничная навигация
Делаем так
        `$query = Product::find()->where(['category_id' => $id]);`
        
         $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3]);
         $products = $query->offset($pages->offset)->limit($pages->limit)->all();
         
Используем виджет для вывода пагинации
    `                    <?php echo LinkPager::widget([
                                 'pagination' => $pages,``
                             ]);
                         ?>`
Убираем get parameters
