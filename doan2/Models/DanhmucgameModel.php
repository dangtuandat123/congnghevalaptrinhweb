
<?php
class DanhmucgameModel extends BaseModel
{
   const TABLE = 'danhmucgame';
   public function getAll()
   {
      return $this->selectAll(self::TABLE);
   }
   public function hienThiDanhMucGame()
   {
      return $this->selectByValue(self::TABLE,'*',
      [
         'trangthai'=>'Bật',
      ]);
   }
   public function timkiem($tukhoa)
   {
      $sql = "SELECT * FROM danhmucgame WHERE trangthai = 'Bật' AND tengame LIKE '%${tukhoa}%'";
      return $this->selectCustom($sql);
   }

   public function getThumbnal($id_danhmucgame)
   {
      $sql = "SELECT img_background,tengame FROM danhmucgame WHERE trangthai = 'Bật' AND id_danhmucgame = '${id_danhmucgame}'";
      return $this->selectCustom($sql);
   }
   public function getName($id_danhmucgame)
   {
      $sql = "SELECT tengame FROM danhmucgame WHERE id_danhmucgame = '${id_danhmucgame}'";
      return $this->selectCustom($sql);
   }
   public function findById($id)
   {
      return 1;
   }
  
   public function quanLyDanhMucLoc($tukhoa,$more = "")
   {
      $sql = "SELECT * FROM danhmucgame WHERE tengame LIKE '%${tukhoa}%' $more";
      return $this->selectCustom($sql);
   }
   public function themDanhMuc($id_danhmucgame,$tengame,$img,$img_background,$trangthai)
   {
      return $this->insert(self::TABLE,[
         'id_danhmucgame'=>$id_danhmucgame,
         'tengame'=>$tengame,
         'img'=>$img,
         'img_background'=>$img_background,
         'trangthai'=>$trangthai,
      ]);
   }
   public function updateDanhMuc($tengame,$img,$img_background,$trangthai,$id_danhmucgame){
      return $this->update(self::TABLE,[

         'tengame'=>$tengame,
         'img'=>$img,
         'img_background'=>$img_background,
         'trangthai'=>$trangthai,
        
      ],[
         'id_danhmucgame'=>$id_danhmucgame,

      ]);
   }
   public function deleteDanhMuc($id_danhmucgame){
      return $this->delete(self::TABLE,[

         'id_danhmucgame'=>$id_danhmucgame,
         
        
      ]);
   }

}
