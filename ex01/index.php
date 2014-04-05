<?php

/* 
 * Copyright 2014 André Aubin <aaubin@student.42.fr>.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

if (session_start() and isset($_GET["login"]) and isset($_GET["passwd"]))
	$_SESSION = array_merge($_SESSION, $_GET);
?>

<html>
	<body>
		<form action="index.php" method="GET">
		    <label for="input-login">Login: </label><input id="input-login" type="text" name="login" value="<?= isset($_SESSION['login']) ? $_SESSION['login'] : "" ?>">
		    <label for="input-passwd">Password: </label><input id="input-passwd" type="password" name="passwd" value="<?= isset($_SESSION['passwd']) ? $_SESSION['passwd'] : "" ?>">
		    <input type="submit" name="submit" value="OK">
		</form>
	</body>
</html>