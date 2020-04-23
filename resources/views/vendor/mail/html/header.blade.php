<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://lh3.googleusercontent.com/proxy/s6P6jyk0eukEUMVi2QX2GBIEjGSFl5tXAZQnBDzAHIiszb4E3Jkt4dJcPSaPxOdhlTUTLDUmr-sZX40plahGxNCDNu9NuOzfiA6FNmpDoDQ7opIfhqw4VPzBlvVo7Gswg0D0VykOrvel6cU" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
