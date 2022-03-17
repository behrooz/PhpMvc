<?php

class m0003_set_defaultvalue_user_status{

    public function up()
    {
        $db = \app\core\Application::$app->db;
        $db->pdo->exec("ALTER TABLE `mvc_framework`.`users` 
                                    CHANGE COLUMN `status` `status` TINYINT NOT NULL DEFAULT 0 ;");
    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $db->pdo->exec("ALTER TABLE `mvc_framework`.`users` 
                        CHANGE COLUMN `status` `status` TINYINT NOT NULL ;");
    }
}