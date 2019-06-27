<?php


namespace app\components;


use yii\base\Widget;
use app\models\Category;

class MenyWidget extends Widget
{
    public $tpl;
    public $data; // данные
    public $tree; // дерево из данных
    public $menuHtml; // шаблон с данными

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

        if (!$this->tpl) {
            $this->tpl = 'menu';
        }

        $this->tpl .= '.php';
    }

    public function run()
    {
        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        debug($this->data);
        return $this->tpl;
    }

    public function getTree()
    {
        $tree = [];
        foreach ($this->data as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$node['id']] = &$node;
            } else {
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
        }
        return $tree;
    }
}