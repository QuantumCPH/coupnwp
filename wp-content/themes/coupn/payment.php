<?php

/*
 * Template Name: Payment Page
 */

?>

<?php
/**
 * Template Name: Payment Page
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

//get_header(); ?>
<html>

<head>

</head>
<body>
<?php

//$subscriptionId = $_REQUEST['subscriptionId'];
//$amount = $_REQUEST['amount'];
//
//$packagename = $_REQUEST['packagename'];
//
//$name = $_REQUEST['fullname'];
//$username = $_REQUEST['username'];
//$email = $_REQUEST['email'];
//$mobile = $_REQUEST['mobile'];
//$password = $_REQUEST['password'];
//$cpassword = $_REQUEST['cpassword'];
////   $address = $_REQUEST['address'];
//// $zipcode = $_REQUEST['zipcode'];
//$address ="";
//$zipcode ="2600";
//$country = $_REQUEST['country'];
//$companyname = $_REQUEST['companyname'];
//$cvr = $_REQUEST['cvr'];
//$patnercode = $_REQUEST['patnercode'];
//
//$cancelurl= get_home_url();
//
//
//$url="http://52.28.59.218:20080/api/User/CreateAdminUser";
//$data = array(
//    'SubscriptionId'=>$subscriptionId,
//    'Amount'=> $amount,
//    'SubscriptionName'=> $packagename,
//    'FullName'=> $name,
//    'Username'=> $username,
//    'Email' => $email,
//    'MobilePhone'=> $mobile,
//    'Password'=> $password,
//    'Street'=> $address,
//    'Zipcode'=> $zipcode,
//    'CompanyName'=> $companyname,
//    'CVR'=> $cvr,
//    'PatnerCode'=> $patnercode,
//    'CountryName'=>$country
//);
//
//
//$options = array(
//    'http' => array(
//        'method'  => 'POST',
//        'content' => json_encode( $data ),
//        'header'=>  "Content-Type: application/json\r\n" .
//            "Accept: application/json\r\n"
//    )
//);
//
//$context  = stream_context_create( $options );
//$result = file_get_contents( $url, false, $context );
//$response = json_decode($result);
//
//
//$yourAmount=$amount*100;
//
//if( $response->Status_Id==3 ) {

    $yourMerchantID = "90218033";
    $yourOrderID = 20;
    $yourCurrency = "DKK";
    $yourAmount = 300000;
    $key1 = "#vCLqCEPLT4wR+f-BS.RI_H(4s]zBfp[";
    $key2 = "5abJzQ)NZ6v+c#SINTF[i#Y^X{?u3?Yv";


    $parameter_string = '';
    $parameter_string .= 'merchant=' . $yourMerchantID;
    $parameter_string .= '&orderid=' . $yourOrderID;
    $parameter_string .= '&currency=' . $yourCurrency;
    $parameter_string .= '&amount=' . $yourAmount;

    $md5key = md5($key2 . md5($key1 . $parameter_string));


    //http://vaultapp.zap-itsolutions.com/getparampay
//http://52.28.59.218:20080/api/User/Payment
    //http://mallappbackend.zap-itsolutions.com/

    ?>

    <FORM ACTION="https://payment.architrade.com/paymentweb/start.action" id="paymentform" name="paymentform" METHOD="POST" CHARSET="UTF-8">
        <INPUT TYPE="hidden" NAME="accepturl" VALUE="<?=home_url('/result')?>">
        <INPUT TYPE="hidden" NAME="cancelurl" VALUE="<?=home_url('/result')?>">


        <INPUT TYPE="hidden" NAME="amount" VALUE="<?php echo 300000 ?>">
        <INPUT TYPE="hidden" NAME="currency" VALUE="DKK">
        <INPUT TYPE="hidden" NAME="merchant" VALUE="<?php echo $yourMerchantID ?>">
        <INPUT TYPE="hidden" NAME="orderid" VALUE="<?php echo $yourOrderID ?>">


        <INPUT TYPE="hidden" NAME="billingAddress" VALUE="2600 copenhagen">
        <INPUT TYPE="hidden" NAME="billingAddress2" VALUE="">
        <INPUT TYPE="hidden" NAME="billingFirstName" VALUE="khan">
        <INPUT TYPE="hidden" NAME="billingLastName" VALUE="">
        <INPUT TYPE="hidden" NAME="billingPostalCode" VALUE="<?php echo 100 ?>">
        <INPUT TYPE="hidden" NAME="billingPostalPlace" VALUE="2600">
        <INPUT TYPE="hidden" NAME="cardholder_name" VALUE="khan muhammad">
        <INPUT TYPE="hidden" NAME="cardholder_address1" VALUE="copenhagen">
        <INPUT TYPE="hidden" NAME="cardholder_zipcode" VALUE="<?php echo 100 ?>">
        <INPUT TYPE="hidden" NAME="email" VALUE="<?php echo $_POST['email'] ?>">

        <INPUT TYPE="hidden" NAME="md5key" VALUE="<?php echo $md5key;  ?>">
        <INPUT TYPE="hidden" NAME="test" VALUE="1">
        <INPUT TYPE="hidden" NAME="maketicket" VALUE="1">
        <INPUT TYPE="hidden" NAME="decorator" VALUE="responsive">

        <input type="hidden" value="submit" >

    </FORM>
    <script type="text/javascript">
        document.getElementById("paymentform").submit();
    </script>

    <?php
//}else{
//
//    $message= $response['Message'];
//}
?>


</body>
</html>
