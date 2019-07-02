<?php


namespace app\controllers;

use app\models\Product;
use app\models\Category;
use Yii;
use yii\data\Pagination;

class CategoryController extends AppController
{
    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();

        $this->setMeta('Eshopper');

        return $this->render('index', compact('hits'));
    }

    public function actionView($id)
    {
//        $id = Yii::$app->request->get('id');

//        $products = Product::find()->where(['category_id' => $id])->all();

        //постраничная навигация
        $query = Product::find()->where(['category_id' => $id]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 3,
            'forcePageParam' => false,
            'pageSizeParam' => false]
            );
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        $category = Category::findOne($id);

        if (!$category) return $this->redirect(['/404/']);

        $this->setMeta('Eshopper ' . $category->name, $category->keywords, $category->description);

        return $this->render('view', compact('products', 'category', 'pages'));
    }
}