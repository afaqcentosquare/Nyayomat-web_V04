<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        /* p{
            line-height: 0.6
        } */
    </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <!-- HIDDEN PREHEADER TEXT -->

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- LOGO -->
        <tr>
            <td bgcolor="#f4f4f4" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 700px;">
                    <tr>
                        <td bgcolor="#ffffff" valign="top"
                            style=" font-size:14px; padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif;">
                            
                            <p>Hi :<strong> {{ $asset_provider_shop_name }}</strong></p><br>

                            <p>Kindly respond to the order below :</p>
                            <p>Order ID : <strong>{{ $order_id }}</strong></p><br>

                            <p>Order Information :</p>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <td><b>Product</b></td>
                                        <td><b>Units</b></td>
                                        <td><b>Unit Price (KES)</b></td>
                                        <td><b>Total (KES)</b></td>
                                    </tr>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$asset_name}}</td>
                                        <td>{{$units}}</td>
                                        <td>{{$unit_price}}</td>
                                        <td>{{$total_cost}}</td>
                                    </tr>
                                    <tr style="padding-top: 10px">
                                        <td><b>Total (KES):</b></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>{{$total_cost}}</b></td>
                                    </tr>

                                </tbody>
                                
                            </table>
                            {{-- <p><b>Total :</b><span style="float: right; margin-right: 95px"><b>KSH {{$total_cost}}</b></span></p><br> --}}

                            <p>Merchant Information : <strong> {{$merchant_shop_name}}</strong></p>
                            <p>Merchant Contact : <strong> {{$merchant_contact}}</strong></p>
                            <p>Merchant Location : <strong> {{$location ? $location.' ,' : $location}} {{ $region }} {{$region ? ', '.$city : $city}}</strong></p><br>

                            <p>We thank you for your cooperation and partnership</p><br>

                            <p>Yours sincerely,</p>
                            <p>Team Nyayomat</p>

                            <p><b>With you , every step</b></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br><br><br>
</body>

</html>
