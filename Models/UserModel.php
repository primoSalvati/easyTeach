<?php



class UserModel extends DB\SQL\Mapper
{

    public function __construct(DB\SQL $db)
    {
        parent::__construct($db, 'easyteach.users');
    }

    public function getByName($name)
    {
        $this->load(array('username=?', $name));
    }

    
}
