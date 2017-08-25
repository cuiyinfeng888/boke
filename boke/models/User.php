<?php

namespace app\models;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $userType;

    public static function tableName()
    {
        return 'admin';
    }

    public function rules()
    {
        return [
            [['userType'], 'integer'],
            [['username','password'], 'string', 'max' =>100],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = self::find()->where(['id'=>$id])->asArray()->one();
        if($user){
            return new static($user);
        }else{
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username,$pwd)
    {
        $user = self::find()->where('username =:name and password = :pwd',[':name'=>$username,':pwd'=>$pwd])->asArray()->one();
        if($user){
            return  new static($user);
        }else{
            return  null;
        }

    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {

    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {

    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
