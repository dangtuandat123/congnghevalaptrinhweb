
<?php
class HoadonModel extends BaseModel
{
    const TABLE = 'hoadon';
    public function getAll()
    {
       return $this->selectAll(self::TABLE);
    }
    public function kiemTraHoaDon($idtaikhoangame,$thoigianhientai)
    {
       return $this->selectByValue(self::TABLE,'id_hoadon',[
      
        'id_taikhoangame'=>$idtaikhoangame,
       ],"AND thoigianhethan > '$thoigianhientai'");
    }
    public function taoHoaDon($idtaikhoangame,$id_nguoidung,$thoigiantao,$thoigianhethan,$giatien,$phuongthucthanhtoan,$trade)
    {
       return $this->insert(self::TABLE,[
      
        'id_taikhoangame'=>$idtaikhoangame,
        'id_nguoidung'=>$id_nguoidung,
        'thoigiantao'=>$thoigiantao,
        'thoigianhethan'=>$thoigianhethan,
        'giatien'=>$giatien,
        'phuongthucthanhtoan'=>$phuongthucthanhtoan,
        'trade'=>$trade,

       ]);
    }
    public function updateHoaDon($magiaodich,$trade,$idnguoidung){
        $this->update(self::TABLE,[
            'tinhtrang'=>'Thành công',
            'magiaodich'=>$magiaodich,
        ],[
            'trade' => $trade,
            'id_nguoidung' => $idnguoidung,

        ]);
    }
    public function doanhThuHomNay()
    {
        
        
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngay_hom_nay = date('Y-m-d');
        $sql = "SELECT SUM(giatien) FROM hoadon WHERE DATE(thoigianhethan) = '$ngay_hom_nay' AND tinhtrang = 'Thành công'";
        return $this->selectCustom($sql);

    }
    public function hienThiAllHoaDon(){
        $sql = "SELECT hoadon.* ,nguoidung.taikhoan  FROM hoadon
        INNER JOIN nguoidung ON hoadon.id_nguoidung = nguoidung.id_nguoidung 
        ORDER BY id_hoadon DESC
        ";
        return $this->selectCustom($sql);
    }
   
}
