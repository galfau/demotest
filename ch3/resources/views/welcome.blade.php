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
			<h1>URLS</h1>

			<table class="table">
				<thead>
					<tr>
						<th>METHOD</th>
						<th>URL</th>
						<th>PARAMS</th>
						<th>INFO</th>
					</tr>
				</thead>
				<tbody>

					<tr>
						<td>{{ url('/api/shortme') }}</td>
						<td>POST</td>
						<td>
							<code>
								{
									"url" : "https://yourlongurl.com/"
								}
							</code>
						</td>
						<td>Generates a short url</td>
					</tr>

					<tr>
						<td>{{ url('/<shortcode>') }}</td>
						<td>GET</td>
						<td>shortcode provided by the shortme API</td>
						<td>Redirects to your url</td>
					</tr>

					<tr>
						<td>{{ url('/top100') }}</td>
						<td>GET</td>
						<td></td>
						<td>Show top 100 visits</td>
					</tr>

				</tbody>
			</table>
		</div>
    </body>
</html>
