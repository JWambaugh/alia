<?php

class User extends Doctrine_Record
{
    public function setTableDefinition()
       {
       $this->setTableName('user');
        // set 'user' table columns, note that
        // id column is auto-created as no primary key is specified

        $this->hasColumn('name', 'string',30);
        $this->hasColumn('username', 'string',20);
        $this->hasColumn('password', 'string',16);
    }

}

