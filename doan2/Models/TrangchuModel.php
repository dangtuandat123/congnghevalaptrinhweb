
<?php
class TrangchuModel extends BaseModel
{
    const TABLE = 'game';
    public function getAll()
    {
       return $this->selectAll(self::TABLE);
    }
    public function findById($id)
    {
       return 1;
    }

}
