@props([
    'url', // The URL the button will link to
    'background' => '#3490dc', // Default background color for the button
    'color' => '#ffffff', // Default text color for the button
    'align' => 'center', // Button alignment
])

<table align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="{{ $align }}">
            <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td>
                        <a href="{{ $url }}" target="_blank" rel="noopener"
                            style="
                            display: inline-block;
                            padding: 10px 20px;
                            font-size: 16px;
                            color: {{ $color }};
                            background-color: {{ $background }};
                            text-decoration: none;
                            border-radius: 5px;
                            text-align: center;
                            font-weight: bold;
                        ">
                            {{ $slot }}
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
