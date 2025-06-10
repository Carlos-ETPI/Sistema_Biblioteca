@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')

<img 
    src="https://i.imgur.com/PC1DqwU.png" 
    alt="Logo" 
    width="350" 
    style="display: block; height: auto; max-width: 100%; object-fit: contain;"
    >

@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
