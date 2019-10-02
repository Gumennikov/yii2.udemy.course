<?php

namespace common\modules\commentary;

/**
 * commentary module definition class
 */
class Commentary extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'common\modules\commentary\controllers';
    public $defaultRoute = 'comment';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
