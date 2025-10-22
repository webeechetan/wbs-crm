@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
<table class="action" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<a href="{{ $url }}" class="button button-{{ $color }}" target="_blank" rel="noopener">{{ $slot }}</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
