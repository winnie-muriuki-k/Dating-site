<!DOCTYPE html>
<html>
<head>
	<title>Dating App</title>
	<style type="text/css">
		body{
		    width: 500px;
		    margin: 50px auto;
		    padding: 10px;
		    border: 3px solid #f3f3f3db;
		    border-radius: 12px;
		}
		h1{
		    text-align: center;
		    color: green;
		    font-size: 2em;
		}
	</style>
</head>
<body>
	<div>
		<h1>Dating App</h1>
		<p>
		Hello , {{$recipient}} ,you have a pending match request from {{$initiator}}.
			Login to your DatingApp and approve it.
		</p>
	</div>
</body>
</html>