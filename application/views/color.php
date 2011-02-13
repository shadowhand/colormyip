<html>
<head>
	<title>Your ip address, in technicolor.</title>
	<style>
	html { font-size: 60%; font-family: sans-serif; background: #eee; color: #111; }
	body { margin: 0; padding: 0; height: 100%; }
	div { padding: 5%; }
	a { color: #111; text-decoration: underline; }
	a:hover { color: #444; }
	table { width: 100%; height: 80%; border-collapse: collapse; border-spacing: 0; }
	table th, table td { padding: 0.4em; text-align: left; font-weight: normal; }
	table th.ip, table td.fork { text-align: right; }
	table tr.colors td { height: 100%; }
	table tr.head,
	table tr.copyright { height: 10%; }
	table tr.copyright { font-size: 0.8em; }
	.right { text-align: right; }
	</style>
</head>
<body>
	<div>
		<table>
			<thead>
				<tr class="head">
					<th colspan="<?php echo floor(count($colors) / 2) ?>"><?php echo $ip ?></th>
					<th colspan="<?php echo ceil(count($colors) / 2) ?>" class="right">colormyip.com</th>
				</tr>
			</thead>
			<tbody>
				<tr class="colors">
				<?php foreach ($colors as $color): ?>
					<td style="background:#<?php echo HTML::chars($color) ?>">&nbsp;</td>
				<?php endforeach ?>
				</tr>
				<tr class="copyright">
					<td colspan="<?php echo ceil(count($colors) / 2) ?>">made by <a href="http://about.me/shadowhand">shadowhand</a></td>
					<td colspan="<?php echo floor(count($colors) / 2) ?>" class="right"><a href="http://github.com/shadowhand/colormyip">fork me</a></td>
				</tr>
			</tbody>
		</table>
	</div>
</html>