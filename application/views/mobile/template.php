<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?=$title?></title>

  <!-- meta -->
  <meta name="description" content="Place to put your description text">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">

  <link rel="shortcut icon" href="<?=base_URL()?>/favicon.ico">
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

  <!-- css -->
  <link rel="stylesheet" href="<?php echo base_url('assets/Template/css/jquery.mobile-1.3.0.min.css')?>">
  <!-- <link rel="stylesheet" href="<?php echo base_url('assets/Template/css/style.css')?>">-->  
  <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome-4.7.0/css/font-awesome.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/Template/datepicker/jquery-ui.css')?>">

  <!-- js -->
  <script type="text/javascript" src="<?php echo base_url('assets/Template/datepicker/jquery-1.10.2.js')?>"></script>
  <script src="<?php echo base_url('assets/Template/js/jquery-1.8.0.min.js')?>"></script>


  <script src="<?php echo base_url('assets/Template/js/jquery.mobile-1.1.0.min.js')?>"></script>
  <!--  <script src="<?php echo base_url('assets/Template/js/custom.js')?>"></script>--> 
  <script type="text/javascript" src="<?php echo base_url('assets/Template/datepicker/jquery-ui.js')?>"></script>

  <style type="text/css" rel="stylesheet">
   .error {
    color: #A94442;
    background-color: #f2dede;
    border-color: #ebccd1;
    padding-right: 35px;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
  }​


  .navbar li a{
    --webkit-transition-duration:0.1s;
    transition-duration: 0.1s;  
    border:none ;
    background: #2a5d84 ;
  }

  b{
    color: #59586D ;
  }

  .navbar li a:hover{
    background: #1f3c52 ;

  }


  .ui-content{
    padding:0px 0px 15px 0px !important;
    background: white ;
  }
  .textarea-container {
    position: relative ;
  }
  .textarea-container textarea {
    width: 100% ;
    height: 100% ;
    box-sizing: border-box ;
  }
  .textarea-container a {
    position: absolute ;
    top: 0;
    right: 0;
  }
  ​.header
  {
    height:40px;
  }
/*.ui-content
{
  position:absolute !important;
  top: 45px;
  left:0px;
  right:0px;
  bottom:0px;
  padding: 0px 0px 15px 0px;

}​*/

input[type=text],input[type=email],input[type=tel] {
  -moz-appearance:textfield ;
  border: none ; 
  border-bottom-style: inset ; 
  border-radius: 0 ;
  box-shadow: none ;
}
.gdate2{text-align:center ;padding:0px;background-color:#fff;color:#a4d0cb;margin-bottom:15px;width: 100px;}
/*font-family: 'Titillium Web',arial,helvetica,sans-serif;*/
.gdate2 .day{display: block;line-height:37px;font-size:40px;}/*padding:4px 0 0px;height:40px;font-weight:bold;*/
.gdate2 .month{display: block;line-height:21px;text-transform:uppercase;font-size: 21px; }/*font-weight:400;margin:4px 0 0;*/
.gdate2 .year{display: block;font-size: 16px;line-height: 18px;margin-top:1px}/*font-weight: 400;margin: 0px 0 4px;*/

</style>

<script>
    if (window.screen.height==568) { // iPhone 4"
      document.querySelector("meta[name=viewport]").content="width=320.1";
  }
</script>

<script>
  $(function() {
    $( "#tgl" ).datepicker();
    $( "#tgl" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(this).scrollTop(0);
  });
</script>

</head>
<body>

  <div data-role="page" data-fullscreen="true" data-dialog="true">

