@props(['url'])

<tr>
    <td class="header" style="padding: 20px 0; text-align: center;">
        <a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
            <img 
                src="{{ asset('images/logo-ns.png') }}" 
                srcset="{{ asset('images/logo-ns.png') }} 1x, {{ asset('images/logo-ns@2x.png') }} 2x"
                alt="Naturaleza Sagrada" 
                class="logo"
                style="height: 60px; width: auto;">
        </a>
    </td>
</tr>

