<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
				padding: 40px 0;
            }
        </style>
    </head>
    <body>
		<div class="container">
			<h1>Top 100 Visits</h1>
			<table class="table">
				<thead>
					<tr>
						<th>URL</th>
						<th>TITLE</th>
						<th>VISITS</th>
					</tr>
				</thead>
				<tbody>
					@foreach($urls as $u)
					<tr>
						<td>{{ $u->url }}</td>
						<td>{{ $u->title }}</td>
						<td>{{ $u->visits }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
    </body>
</html>
