<!-- http://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=QTXBBa1huJdOD3RuorvxfrZv9PQBtAhxiYRR1TnA3kUYKVGCOFhHP_fZt7hzWznGH0QVGsmRCtGIZZ1T6jG8om__6Y1n1MwdsC9RoAkU9DXYNr1a8yKKWLOBTZhUPu76VLJhAJAZPN -->
<!-- http://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=ACCESS_TOKEN -->
<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx151461669b255af0", "d16166cdff755f42cb3e14d568e297b7");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>蘑菇智能科技wifi配置</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
  <link rel="stylesheet" href="airkiss.css">
  <script src="zepto.min.js"></script>
  <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
</head>
<body ontouchstart="">
  <div class="box" style="overflow: hidden;">
    <img alt="" src="logo.png" class="logo">
    <div style="margin-top: 10%">1.确定手机已连接到WiFi</div>
    <div>2.请长按设备上的配置按钮3秒</div>
    <div>3.输入此WiFi密码,并点击连接</div>  
    <button alt="" value="连接WIFI" class="connectWifi">   
  </div>
</body>
<script>
  wx.config({
    beta: true,
    // debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
  jsApiList: [
    'getNetworkType',
    'configWXDeviceWiFi',
    'hideMenuItems'
    ]
  });
  wx.ready(function() {
    wx.hideOptionMenu();
    wx.getNetworkType({
      success: function (res) {
        if(res.networkType !== "wifi"){
           alert("请连接wifi网络");
        }
      },
      fail: function (res) {
        alert("请连接wifi网络");
      }
    });
    $(".connectWifi").click(function(){
      wx.invoke('configWXDeviceWiFi', {}, function(res) {
        if (res.err_msg == 'configWXDeviceWiFi:ok') {
          alert("配置成功");
          wx.closeWindow();
          // WeixinJSBridge.call('closeWindow');
        } else if (res.err_msg == 'configWXDeviceWiFi:fail') {
          alert("配置失败!请重新配置");
        }
      });
    });
  });
  wx.error(function(res) {
    alert(res.errMsg);
  });
</script>
</html>
