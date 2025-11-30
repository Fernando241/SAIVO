<tr>
    <td>
        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="text-align: center; margin-top: 20px;">
            <tr>
                <td class="content-cell" align="center" style="padding: 20px 0; color: #6B6B6B; font-size: 12px; line-height: 18px;">

                    {{-- Contenido dinámico del correo --}}
                    {{ Illuminate\Mail\Markdown::parse($slot) }}

                    {{-- Línea divisoria discreta --}}
                    <div style="margin: 20px auto; width: 80%; border-top: 1px solid #E5E5E5;"></div>

                    {{-- Identidad de marca --}}
                    <p style="margin: 0; font-size: 12px; color: #6B6B6B;">
                        © {{ date('Y') }} Naturaleza Sagrada SAS BIC.<br>
                        Salud indígena, ciencia y tradición en equilibrio.
                    </p>

                    {{-- Enlace al sitio --}}
                    <p style="margin: 8px 0 0;">
                        <a href="https://naturalezasagradasas.com" 
                            style="color: #4A7A3C; text-decoration: none; font-weight: 600;">
                            naturalezasagradasas.com
                        </a>
                    </p>

                </td>
            </tr>
        </table>
    </td>
</tr>
