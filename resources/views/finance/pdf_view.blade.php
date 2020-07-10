<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<html>
    <head>
        <style>
            body {
                font-size: 12px;
            }
            table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            .td-main, .th-main {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
            font-size: 8px !important;
            }

            .th-inside, .td-inside {
                text-align: left;
                padding: 2px;
                font-size: 8px !important;
            }

            .inside-row:nth-child(even) {
                background-color: whitesmoke;
            }
            .custom-td{
                white-space: break-spaces;
                width: 65%;
            }
        </style>
    </head>
    <body>
        @if (count($show)>0)
            @foreach ($show as $item)
                <span>{{$item->desc}}</span>
            @endforeach
        @endif
        <div style="margin-bottom: 5px;">
            <span>Expenses for <strong>Jully, 2020</strong></span><span style="float: right;">Total: <strong>20000000sh</strong></span><br>
        </div>
        <table>
            <thead>
                <tr>
                    <th scope="col" class="th-main">Description</th>
                    <th scope="col" class="th-main">Budget</th>
                    <th scope="col" class="th-main">user</th>
                    <th scope="col" class="th-main">Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="td-main">
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" class="th-inside">Items</th>
                                    <th scope="col" class="th-inside">quantity</th>
                                    <th scope="col" class="th-inside">unit</th>
                                    <th scope="col" class="th-inside">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="inside">
                                <tr class="inside-row">
                                    <td class="custom-td td-inside">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the </td>
                                    <td class="td-inside">5</td>
                                    <td class="td-inside">500</td>
                                    <td class="td-inside">2500</td>
                                </tr>
                                <tr class="inside-row">
                                    <td class="custom-td td-inside">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the </td>
                                    <td class="td-inside">5</td>
                                    <td class="td-inside">500</td>
                                    <td class="td-inside">2500</td>
                                </tr>
                                <tr class="inside-row">
                                    <td class="custom-td td-inside">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the </td>
                                    <td class="td-inside">5</td>
                                    <td class="td-inside">500</td>
                                    <td class="td-inside">2500</td>
                                </tr>
                                <tr class="inside-row">
                                    <td class="custom-td td-inside">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the </td>
                                    <td class="td-inside">5</td>
                                    <td class="td-inside">500</td>
                                    <td class="td-inside">2500</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="td-main">30000</td>
                    <td class="td-main">Bryan</td>
                    <td class="td-main">10/07/2020</td>
                </tr>
                <tr>
                    <td class="td-main">
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col" class="th-inside">Items</th>
                                    <th scope="col" class="th-inside">quantity</th>
                                    <th scope="col" class="th-inside">unit</th>
                                    <th scope="col" class="th-inside">Amount</th>
                                </tr>
                            </thead>
                            <tbody class="inside">
                                <tr class="inside-row">
                                    <td class="custom-td td-inside">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the </td>
                                    <td class="td-inside">5</td>
                                    <td class="td-inside">500</td>
                                    <td class="td-inside">2500</td>
                                </tr>
                                <tr class="inside-row">
                                    <td class="custom-td td-inside">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the </td>
                                    <td class="td-inside">5</td>
                                    <td class="td-inside">500</td>
                                    <td class="td-inside">2500</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="td-main">30000</td>
                    <td class="td-main">Bryan</td>
                    <td class="td-main">10/07/2020</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>