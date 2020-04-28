<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://lh3.googleusercontent.com/proxy/5uk7prBcyeJPaImhdSFGCEuUkOUY7aFqJTmd9hhwPK0B5xqZrRkl4UY8t1h_aGC9bpu2L-sDo_misdWjrLuocBOgUOxFcLbKiyne40kZi4fpK8TNk-MewP7ixnx1QngxHVBZIOZmCFpWLco" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
