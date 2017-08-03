function FormCheck() {

	// 未入力チェック

	var val = document.getElementsByName("accountname")[0];
	var val2 = document.getElementsByName("password")[0];

  var flg = false;
  var message = "";

  if(jsTrim(val.value).length == 0){
    message += "アカウント名";
    flg = true;
  }

  if(jsTrim(val2.value).length == 0){
    if(flg == true){
      message += "、パスワード"
    }else{
      message += "パスワード";
      flg = true;
    }
  }

  if(flg == true){
    message += "が入力されていません";
    alert(message);
    val.focus();
    return false;
  }

	// 前後スペース削除(全角半角対応)
	function jsTrim( val ) {

		var ret = val;

		ret = ret.replace( /^[\s]*/, "" );
		ret = ret.replace( /[\s]*$/, "" );

		return ret;
	}

	// 前スペース削除(全角半角対応)
	function jsLTrim( val ) {
		var ret = val;

		ret = ret.replace( /^[\s]*/, "" );

		return ret;
	}

	// 後スペース削除(全角半角対応)
	function jsRTrim( val ) {
		var ret = val;

		ret = ret.replace( /^[\s]*/, "" );

		return ret;
	}
}
