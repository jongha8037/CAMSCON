<!DOCTYPE html>
<html lang="ko-KR">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>비밀번호 재설정</h2>

		<div>
			다음 링크를 이용하여 비밀번호 재설정을 하시기 바랍니다: <a href="{{ URL::to('auth/user/reset-password', array($token)) }}">{{ URL::to('auth/user/reset-password', array($token)) }}</a><br/>
			본 링크는 발급된 시점으로부터 {{ Config::get('auth.reminder.expire', 60) }}분 동안 유효합니다.
		</div>
	</body>
</html>
