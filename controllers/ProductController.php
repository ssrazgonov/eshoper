<?php


namespace app\controllers;

use app\models\Product;
use app\models\Category;
use Yii;


class ProductController extends AppController
{
    public function actionView($id)
    {
        $product = Product::findOne($id);
        $this->setMeta($product->name, $product->keywords, $product->description);
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        return $this->render('view', compact('product', 'hits'));
    }
}