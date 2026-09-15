<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle commande</title>
</head>
<body style="margin:0;padding:0;background-color:#F8F9F5;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;color:#1a2217;-webkit-font-smoothing:antialiased;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="padding:40px 16px;background-color:#F8F9F5;">
    <tr>
        <td align="center">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;background-color:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 10px 25px -5px rgba(0,0,0,0.05);border:1px solid #e5e7eb;">
                
                {{-- Header --}}
                <tr>
                    <td style="background-color:#1a2217;padding:24px 32px;border-bottom:4px solid #d4f977;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="color:#ffffff;font-size:20px;font-weight:700;">
                                    🛒 Nouvelle Commande
                                </td>
                                <td align="right" style="color:#9ca3af;font-size:14px;">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- Corps --}}
                <tr>
                    <td style="padding:32px;">
                        
                        {{-- Infos Principales --}}
                        <div style="background-color:#f9fafb;border-radius:8px;padding:20px;margin-bottom:24px;border:1px solid #f3f4f6;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="50%" style="padding-bottom:12px;">
                                        <span style="color:#6b7280;font-size:12px;text-transform:uppercase;letter-spacing:0.5px;">Référence</span><br>
                                        <strong style="color:#111827;font-size:16px;">{{ $order->reference }}</strong>
                                    </td>
                                    <td width="50%" style="padding-bottom:12px;">
                                        <span style="color:#6b7280;font-size:12px;text-transform:uppercase;letter-spacing:0.5px;">Montant Total</span><br>
                                        <strong style="color:#111827;font-size:16px;">{{ number_format((float) $order->total, 2, ',', ' ') }} {{ $order->currency }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span style="color:#6b7280;font-size:12px;text-transform:uppercase;letter-spacing:0.5px;">Paiement</span><br>
                                        <span style="color:#111827;font-size:14px;">{{ $order->payment_method ?? 'N/A' }} ({{ $order->payment_status }})</span>
                                    </td>
                                    <td>
                                        <span style="color:#6b7280;font-size:12px;text-transform:uppercase;letter-spacing:0.5px;">Statut</span><br>
                                        <span style="color:#111827;font-size:14px;background-color:#fef3c7;color:#92400e;padding:2px 8px;border-radius:999px;font-weight:600;">{{ $order->status }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        {{-- Client & Livraison --}}
                        <h2 style="margin:0 0 12px;font-size:16px;font-weight:700;color:#111827;border-bottom:1px solid #e5e7eb;padding-bottom:8px;">
                            Client & Livraison
                        </h2>
                        <p style="margin:0 0 24px;color:#4b5563;font-size:14px;line-height:1.6;">
                            <strong style="color:#111827;">{{ $order->first_name }} {{ $order->last_name }}</strong><br>
                            📧 {{ $order->email }}<br>
                            📞 {{ $order->phone ?? 'N/A' }}<br>
                            📍 {{ $order->address }}, {{ $order->postal_code }} {{ $order->city }}, {{ $order->country }}
                        </p>

                        {{-- Articles --}}
                        <h2 style="margin:0 0 12px;font-size:16px;font-weight:700;color:#111827;border-bottom:1px solid #e5e7eb;padding-bottom:8px;">
                            Articles commandés
                        </h2>
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:32px;">
                            @if($order->items)
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td style="padding:10px 0;border-bottom:1px solid #f3f4f6;font-size:14px;color:#4b5563;">
                                            <strong style="color:#111827;">{{ $item->quantity }} ×</strong> {{ $item->product_name }}
                                        </td>
                                        <td align="right" style="padding:10px 0;border-bottom:1px solid #f3f4f6;font-size:14px;font-weight:600;color:#111827;">
                                            {{ number_format((float) $item->total_price, 2, ',', ' ') }} {{ $order->currency }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            <tr>
                                <td style="padding:10px 0;font-size:14px;color:#6b7280;">Livraison</td>
                                <td align="right" style="padding:10px 0;font-size:14px;color:#6b7280;">
                                    {{ number_format((float) $order->shipping_cost, 2, ',', ' ') }} {{ $order->currency }}
                                </td>
                            </tr>
                        </table>

                        {{-- CTA --}}
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center">
                                    <a href="{{ url('/admin/orders/' . $order->id) }}"
                                       style="display:inline-block;background-color:#1a2217;color:#ffffff;font-size:14px;font-weight:600;text-decoration:none;padding:12px 24px;border-radius:8px;">
                                        Ouvrir dans l'administration
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
