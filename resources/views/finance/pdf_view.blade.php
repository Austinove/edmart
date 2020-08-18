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
        <div style="margin-bottom: 5px;">
            {{-- retrieving month --}}
            <span>Expenses for
                <strong>
                    @if ($month)
                        @switch($month)
                            @case("-01-")
                                January, {{date('Y')}}
                                @break
                            @case("-02-")
                                Febrary, {{date('Y')}}
                                @break
                            @case("-03-")
                                March, {{date('Y')}}
                                @break
                            @case("-04-")
                                April, {{date('Y')}}
                                @break
                            @case("-05-")
                                May, {{date('Y')}}
                                @break
                            @case("-06-")
                                June, {{date('Y')}}
                                @break
                            @case("-07-")
                                Jully, {{date('Y')}}
                                @break
                            @case("-08-")
                                August, {{date('Y')}}
                                @break
                            @case("-09-")
                                September, {{date('Y')}}
                                @break
                            @case("-10-")
                                October, {{date('Y')}}
                                @break
                            @case("-11-")
                                November, {{date('Y')}}
                                @break
                            @case("-12-")
                                December, {{date('Y')}}
                                @break
                            @default
                                @break
                        @endswitch
                    @endif
                </strong>
            </span>
            <span style="float: right;">Total: 
                <strong>
                    @if (count($show)>0)
                        @php
                            $sum = 0;
                            foreach ($show as $item){
                            $sum += intval($item->amount);
                            }
                        @endphp
                        {{$sum}}
                    @endif
                </strong>
            </span>
            <br>
        </div>
        <table>
            <thead>
                <tr>
                    <th scope="col" class="th-main">Description</th>
                    <th scope="col" class="th-main">Budget</th>
                    <th scope="col" class="th-main">Name</th>
                    <th scope="col" class="th-main">Date/Time</th>
                </tr>
            </thead>
            <tbody>
                @if (count($show)>0)
                    @foreach ($show as $item)
                        <tr>
                            <td class="td-main">
                                <table>
                                    <thead>
                                        <tr>
                                            <th scope="col" class="th-inside">{{explode('>|<', $item->desc)[0]}}</th>
                                            <th scope="col" class="th-inside">quantity</th>
                                            <th scope="col" class="th-inside">unit</th>
                                            <th scope="col" class="th-inside">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="inside">
                                        @for ($i = 0; $i < count(explode('||', (explode('>|<', $item->desc)[1]))); $i++)
                                            <tr class="inside-row">
                                                <td class="custom-td td-inside">{{explode('<>', (explode('||', (explode('>|<', $item->desc)[1]))[$i]))[0]}}</td>
                                                <td class="td-inside">{{explode('<>', (explode('||', (explode('>|<', $item->desc)[1]))[$i]))[1]}}</td>
                                                <td class="td-inside">{{explode('<>', (explode('||', (explode('>|<', $item->desc)[1]))[$i]))[2]}}</td>
                                                <td class="td-inside">{{explode('<>', (explode('||', (explode('>|<', $item->desc)[1]))[$i]))[3]}}</td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </td>
                            <td class="td-main">{{$item->amount}}</td>
                            <td class="td-main">{{$item->name}}</td>
                            <td class="td-main">{{$item->created_at}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </body>
</html>