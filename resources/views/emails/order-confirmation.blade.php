<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande</title>
</head>
<body style="margin:0;padding:0;background-color:#F8F9F5;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;color:#1a2217;-webkit-font-smoothing:antialiased;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="padding:40px 16px;background-color:#F8F9F5;">
    <tr>
        <td align="center">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;background-color:#ffffff;border-radius:24px;overflow:hidden;box-shadow:0 10px 25px -5px rgba(0,0,0,0.05);">

                {{-- Header --}}
                <tr>
                    <td style="background-color:#1a2217;padding:36px 40px;text-align:center;">
                        <span style="color:#d4f977;font-size:26px;font-weight:900;letter-spacing:2px;text-transform:uppercase;">Cleaner.</span>
                    </td>
                </tr>

                {{-- Corps --}}
                <tr>
                    <td style="padding:40px;">
                        <h1 style="margin:0 0 16px;font-size:24px;font-weight:800;color:#1a2217;">Merci pour votre commande, {{ $order->first_name }} ! 🍃</h1>
                        <p style="margin:0 0 12px;color:#4b5563;font-size:16px;line-height:1.6;">
                            Votre commande <strong>{{ $order->reference }}</strong> est bien confirmée. Nous la préparons avec le plus grand soin.
                        </p>
                        <p style="margin:0 0 32px;color:#4b5563;font-size:16px;line-height:1.6;">
                            Vous recevrez un e-mail avec un lien de suivi dès que votre colis quittera notre atelier.
                        </p>

                        {{-- Section Récapitulatif --}}
                        <div style="background-color:#f4f7f4;border-radius:16px;padding:24px;margin-bottom:32px;">
                            <h2 style="margin:0 0 16px;font-size:18px;font-weight:700;color:#1a2217;border-bottom:1px solid #e5e7eb;padding-bottom:12px;">
                                Récapitulatif de votre commande
                            </h2>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                @if($order->items)
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td style="padding:12px 0;border-bottom:1px solid #e5e7eb;color:#1a2217;font-size:15px;">
                                                <strong style="color:#435b39;">{{ $item->quantity }} ×</strong> {{ $item->product_name }}
                                            </td>
                                            <td align="right" style="padding:12px 0;border-bottom:1px solid #e5e7eb;color:#1a2217;font-size:15px;font-weight:500;">
                                                {{ number_format((float) $item->total_price, 2, ',', ' ') }} {{ $order->currency }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <td style="padding:16px 0 8px;color:#6b7280;font-size:15px;">Frais de livraison</td>
                                    <td align="right" style="padding:16px 0 8px;color:#6b7280;font-size:15px;">
                                        @if ((float) $order->shipping_cost > 0)
                                            {{ number_format((float) $order->shipping_cost, 2, ',', ' ') }} {{ $order->currency }}
                                        @else
                                            <span style="color:#435b39;font-weight:600;">Offerte</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 0 0;font-size:20px;font-weight:800;color:#1a2217;">Total</td>
                                    <td align="right" style="padding:12px 0 0;font-size:20px;font-weight:800;color:#1a2217;">
                                        {{ number_format((float) $order->total, 2, ',', ' ') }} {{ $order->currency }}
                                    </td>
                                </tr>
                            </table>
                        </div>

                        {{-- Infos Livraison --}}
                        <h2 style="margin:0 0 12px;font-size:18px;font-weight:700;color:#1a2217;">Adresse de livraison</h2>
                        <p style="margin:0 0 32px;color:#4b5563;font-size:15px;line-height:1.6;background-color:#ffffff;border:1px solid #e5e7eb;border-radius:12px;padding:16px;">
                            <strong>{{ $order->first_name }} {{ $order->last_name }}</strong><br>
                            {{ $order->address }}<br>
                            @if($order->postal_code){{ $order->postal_code }} @endif{{ $order->city }}<br>
                            {{ $order->country }}<br>
                            @if($order->phone)<span style="color:#9ca3af;font-size:14px;margin-top:4px;display:inline-block;">📞 {{ $order->phone }}</span>@endif
                        </p>

                        {{-- CTA --}}
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                               
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- Footer --}}
                <tr>
                    <td style="padding:32px 40px;background-color:#F8F9F5;color:#6b7280;font-size:13px;line-height:1.6;text-align:center;border-top:1px solid #e5e7eb;">
                        <strong>Cleaner</strong> — Votre rituel bien-être<br>
                        Une question sur votre commande ? Répondez simplement à cet e-mail pour contacter notre équipe.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
