function FormCheck() {

	// 未入力チェック
	var val = document.getElementsByName("accountname")[0];
	if ( jsTrim( val.value ).length == 0 ) {
		alert( "アカウント名は必須入力です" );
		val.focus();
		return false;
	}
	
	// 未入力チェック
	var val = document.getElementsByName("username")[0];
	if ( jsTrim( val.value ).length == 0 ) {
		alert( "ユーザーネーム(表示名)は必須入力です" );
		val.focus();
		return false;
	}

	// 未入力チェック
	var val = document.getElementsByName("password")[0];
	if ( jsTrim( val.value ).length == 0 ) {
		alert( "パスワードは必須入力です" );
		val.focus();
		return false;
	}
	
	// 未入力チェック
	var val = document.getElementsByName("password2")[0];
	if ( jsTrim( val.value ).length == 0 ) {
		alert( "パスワード(再入力)は必須入力です" );
		val.focus();
		return false;
	}
	
	//パスワードチェック
	if (form1.password.value != form1.password2.value) {
		alert("パスワードが一致しません");
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