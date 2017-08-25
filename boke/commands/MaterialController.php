<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use app\models\NewUserOpenid;
use app\models\Tool;
use app\models\WxMaterial;
/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MaterialController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionUpdatematerial()
    {
        $field = ['media_id', 'name', 'update_time', 'url'];
        $imageMaterial = Tool::getAllWxMaterial('image');
        $imageCount = count($imageMaterial);
        $image_success =0;
        foreach ($imageMaterial as $imk => $imv) {
            if(!preg_match('/hui/',$imv['name'])) continue;
            $isExist = WxMaterial::find()->select('media_id')->where('media_id=:m', [':m' => $imv['media_id']])->one();
            if ($isExist) {
                $model = $isExist;
            } else {
                $model = new WxMaterial();
            }
            foreach ($field as $fv) {
                if (isset($imv[$fv])) {
                    $model->$fv = $imv[$fv];
                }
            }
            $model->media_type = 'image';
            if ($model->save()) {
                $image_success++;
                echo $imageCount . ' image material ,the ' . ($imk + 1) . ' update success' . "\n";
            } else {
                echo $imageCount . ' image material ,the ' . ($imk + 1) . ' update failed' . "\n";
            }

        }
        echo $imageCount . ' image material ' .$image_success . ' update success' . "\n";

        $voiceMaterial = Tool::getAllWxMaterial('voice');
        $voiceCount = count($voiceMaterial);
        $voice_success = 0;
        foreach ($voiceMaterial as $vmk => $vmv) {
            $isExist = WxMaterial::find()->select('media_id')->where('media_id=:m', [':m' => $vmv['media_id']])->one();
            if ($isExist) {
                $model = $isExist;
            } else {
                $model = new WxMaterial();
            }
            foreach ($field as $fv) {
                if (isset($vmv[$fv])) {
                    $model->$fv = $vmv[$fv];
                }
            }
            $model->media_type = 'voice';
            if ($model->save()) {
                $voice_success++;
                echo $voiceCount . ' voice material,the ' . ($vmk + 1) . ' update success' . "\n";
            } else {
                echo $voiceCount . ' voice material,the ' . ($vmk + 1) . ' update failed' . "\n";
            }

        }
        echo $voiceCount . ' voice material ' .$voice_success. ' update success' . "\n";
    }
}
