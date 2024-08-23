{{-- @props(['url'])
<tr>
    <td class="header" align="center">
        <a href="{{ $url }}"
            style="display: inline-block; text-align: center; padding: 10px 20px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold;">
            {{ $slot }}
        </a>
    </td>
</tr> --}}

@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
