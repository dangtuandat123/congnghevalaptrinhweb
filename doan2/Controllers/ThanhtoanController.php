<?php

class ThanhtoanController extends BaseController
{
    private $TaikhoangameModel;
    private $HoadonModel;
    private $NguoidungModel;
    private $DonhangModel;
    private $AdminModel;
    public function __construct()
    {
        // load file model
        $this->loadModel('TaikhoangameModel');
        $this->TaikhoangameModel = new TaikhoangameModel;
        $this->loadModel('HoadonModel');
        $this->HoadonModel = new HoadonModel;
        $this->loadModel('NguoidungModel');
        $this->NguoidungModel = new NguoidungModel;
        $this->loadModel('DonhangModel');
        $this->DonhangModel = new DonhangModel;
        $this->loadModel('AdminModel');
        $this->AdminModel = new AdminModel;
    }
    private function randomString($length = 20)
    {
        $bytes = openssl_random_pseudo_bytes($length);

        $str = bin2hex($bytes);

        return substr($str, 0, $length);
    }

    public function index()

    {

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $idtaikhoangame = $_GET['idtaikhoangame'] ?? null;
        $iddanhmucgame = $_GET['iddanhmucgame'] ?? null;

        $idnguoidung = $_SESSION['id_nguoidung'] ?? null;

        $startTime_ = date("YmdHis");
        $thoigianhientai = date('Y-m-d H:i:s', strtotime('+0 minutes', strtotime($startTime_)));
        $kiemtrahoadontontai = $this->HoadonModel->kiemTraHoaDon($idtaikhoangame, $thoigianhientai);

        $kiemtaikhoanchuaban = $this->TaikhoangameModel->kiemTraChuaBan($idtaikhoangame);


        // $kiemtradonhang = $this->DonhangModel->kiemTraDonHang($idnguoidung, $idtaikhoangame);


        if (count($kiemtrahoadontontai) == 0 && count($kiemtaikhoanchuaban) == 1) {
            $sotien = $_GET['sotien'];
            $phuongthuc = $_GET['phuongthucthanhtoan'];
            if ($phuongthuc == 'vnpay') {

                $caidatvnpay = $this->AdminModel->caiDatVnpay();

                $trade = $this->randomString();
                error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                date_default_timezone_set('Asia/Ho_Chi_Minh');

                $vnp_TmnCode = $caidatvnpay[0]['terminal_id']; //Mã định danh merchant kết nối (Terminal Id)
                $vnp_HashSecret = $caidatvnpay[0]['secret_key']; //Secret key
                $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                $vnp_Returnurl = "http://localhost/doan2/index.php?controller=thanhtoan&action=vnpay_return&trade=$trade&idtaikhoangame=$idtaikhoangame";
                $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
                $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
                $startTime = date("YmdHis");
                $expire = date('YmdHis', strtotime('+5 minutes', strtotime($startTime)));

                $thoigiantaohoadon = date('Y-m-d H:i:s', strtotime('+0 minutes', strtotime($startTime)));
                $thoigianhethanhoadon = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime($startTime)));

                $this->HoadonModel->taoHoaDon($idtaikhoangame, $idnguoidung, $thoigiantaohoadon, $thoigianhethanhoadon, $sotien, $phuongthuc, $trade);

                $vnp_TxnRef = rand(1, 10000); //Mã giao dịch thanh toán tham chiếu của merchant
                $vnp_Amount = $sotien; // Số tiền thanh toán
                $vnp_Locale = "vn"; //Ngôn ngữ chuyển hướng thanh toán
                $vnp_BankCode = $_POST['bankCode']; //Mã phương thức thanh toán
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR']; //IP Khách hàng thanh toán

                $inputData = array(
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount * 100,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_TxnRef,
                    "vnp_OrderType" => "other",
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef,
                    "vnp_ExpireDate" => $expire
                );

                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }

                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }

                $vnp_Url = $vnp_Url . "?" . $query;
                if (isset($vnp_HashSecret)) {
                    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
                }
                header('Location: ' . $vnp_Url);
                die();
            } elseif ($phuongthuc == 'momo') {

                function execPostRequest($url, $data)
                {
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt(
                        $ch,
                        CURLOPT_HTTPHEADER,
                        array(
                            'Content-Type: application/json',
                            'Content-Length: ' . strlen($data)
                        )
                    );
                    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                    //execute post
                    $result = curl_exec($ch);
                    //close connection
                    curl_close($ch);
                    return $result;
                }


                if (empty($_POST)) {
                    $trade = $this->randomString();
                    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

                    $caidatmomo = $this->AdminModel->caidatmomo();

                    // $partnerCode = 'MOMOBKUN20180529';
                    // $accessKey = 'klm05TvNBzhg7h7j';
                    // $serectkey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                    $partnerCode = $caidatmomo[0]['partnercode'];
                    $accessKey = $caidatmomo[0]['accesskey'];
                    $serectkey = $caidatmomo[0]['secretkey'];

                    $orderInfo = "Thanh toán qua MoMo";
                    $sotien = round($sotien);
                    $amount = (string)$sotien;

                    $orderId = time() . "";
                    $redirectUrl = "http://localhost/doan2/index.php?controller=thanhtoan&action=momo_return&trade=$trade&idtaikhoangame=$idtaikhoangame";
                    $ipnUrl = "http://localhost/doan2/index.php?controller=thanhtoan&action=momo_return&trade=$trade&idtaikhoangame=$idtaikhoangame";
                    $extraData = "";



                    $startTime = date("YmdHis");
                    $thoigiantaohoadon = date('Y-m-d H:i:s', strtotime('+0 minutes', strtotime($startTime)));
                    $thoigianhethanhoadon = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime($startTime)));
                    $this->HoadonModel->taoHoaDon($idtaikhoangame, $idnguoidung, $thoigiantaohoadon, $thoigianhethanhoadon, $sotien, $phuongthuc, $trade);

                    $requestId = time() . "";
                    $requestType = "payWithATM";
                    //before sign HMAC SHA256 signature
                    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                    $signature = hash_hmac("sha256", $rawHash, $serectkey);
                    $data = array(
                        'partnerCode' => $partnerCode,
                        'partnerName' => "Test",
                        "storeId" => "MomoTestStore",
                        'requestId' => $requestId,
                        'amount' => $amount,
                        'orderId' => $orderId,
                        'orderInfo' => $orderInfo,
                        'redirectUrl' => $redirectUrl,
                        'ipnUrl' => $ipnUrl,
                        'lang' => 'vi',
                        'extraData' => $extraData,
                        'requestType' => $requestType,
                        'signature' => $signature
                    );
                    // echo "<pre>";
                    // print_r($data);
                    // die();
                    $result = execPostRequest($endpoint, json_encode($data));
                    $jsonResult = json_decode($result, true);  // decode json

                    //Just a example, please check more in there

                    header('Location: ' . $jsonResult['payUrl']);
                }
            }
        } else {
            echo "<script>
            alert('Đơn hàng không khả dụng, quay lại sau ít phút!');
            window.location.href = './index.php?controller=taikhoangame&idtaikhoangame=$idtaikhoangame&iddanhmucgame=$iddanhmucgame';
           </script>";
        }
    }
    public function vnpay_return()
    {
        $caidatvnpay = $this->AdminModel->caiDatVnpay();

        $vnp_TmnCode = $caidatvnpay[0]['terminal_id'];
        $vnp_HashSecret = $caidatvnpay[0]['secret_key'];
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/vnpay_php/vnpay_return.php";
        $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
        $apiUrl = "https://sandbox.vnpayment.vn/merchant_webapi/api/transaction";
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+5 minutes', strtotime($startTime)));


        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        // echo $_GET['vnp_TxnRef'];
        // echo $_GET['vnp_Amount'];
        // echo $_GET['vnp_OrderInfo'];
        // echo $_GET['vnp_ResponseCode'];
        // echo $_GET['vnp_TransactionNo'];
        // echo $_GET['vnp_BankCode'];
        // echo $_GET['vnp_PayDate'];
        // echo $_GET['trade'];
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                // echo "<span style='color:blue'>GD Thanh cong</span>";
                $this->HoadonModel->updateHoaDon($_GET['vnp_TransactionNo'], $_GET['trade'], $_SESSION['id_nguoidung']);
                $this->TaikhoangameModel->updateTaiKhoanGame($_GET['idtaikhoangame']);
                $this->DonhangModel->insertDonhang($_SESSION['id_nguoidung'], $_GET['idtaikhoangame']);
                // die();
                echo "<script>
                alert('Đã thanh toán thành công!');
                window.location.href = './index.php?controller=nguoidung&action=lichsumuahang';
               </script>";
            } else {
                echo "<script>
                alert('Thanh toán không thành công!');
                window.location.href = './index.php';
               </script>";
            }
        } else {
            echo "<script>
            alert('Thanh toán không hợp lệ');
            window.location.href = './index.php';
           </script>";
        };
    }
    public function momo_return()
    {
        $matrave = $_GET['resultCode'];
        if ($matrave == "0") {
            // echo "<span style='color:blue'>GD Thanh cong</span>";
            $this->HoadonModel->updateHoaDon($_GET['transId'], $_GET['trade'], $_SESSION['id_nguoidung']);
            $this->TaikhoangameModel->updateTaiKhoanGame($_GET['idtaikhoangame']);
            $this->DonhangModel->insertDonhang($_SESSION['id_nguoidung'], $_GET['idtaikhoangame']);
            // die();
            echo "<script>
                alert('Đã thanh toán thành công!');
                window.location.href = './index.php?controller=nguoidung&action=lichsumuahang';
               </script>";
        } else {
            echo "<script>
            alert('Thanh toán không thành công!');
            window.location.href = './index.php';
           </script>";
        };
    }
}
