<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Suhov</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            ul{
                padding: 0;
                list-style: none;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="{{ url('/login') }}">Login</a>
                    <a href="{{ url('/register') }}">Register</a>
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Data Imaging Solutions
                </div>

                <div class="links">
                    <a href="{{route('rcadm.create')}}">Data Entry</a>                    
                    <a href="./pachet">Pachete</a>                    
                </div>                                              
            </div>
        </div>
        <?php return; ?>
                <table border="1" width="100%">
                    <tr>
                        <td>resources</td>
                        <th colspan="2" >AUTH</th>                        
                        <th>Data Entry</th>
                        <th>Pachet</th>
                        <th>Scan</th>
                        <th>Campuri</th>
                    </tr>
                    <tr style="vertical-align: text-top;">                            
                        <td>
                            <ul>
                                <li>index</li>
                                <li>create</li>
                                <li>store</li>
                                <li>show</li>
                                <li>edit</li>
                                <li>update</li>
                                <li>destroy</li>
                            </ul>
                        </td>                                                
                        <td>
                            <ul>
                                <li><a href="{{route('user.index')}}">user.index</a></li>
                                <li><a href="{{route('user.create')}}">user.create</a> invite</li>
                                <li>user.store</li>
                                <li><a href="{{ route('user.show' , ['id' => 1]) }}">rcadm.show/1</a></li>
                                <li><a href="{{ route('user.edit' , ['id' => 1]) }}">rcadm.edit/1</a></li>
                                <li>user.update</li>
                                <li>user.destroy</li>
                            </ul>
                            <hr>
                            (api)/remove_role/role_id  <br />
                            <a href="{{ url('/register') }}">Register</a> <br />
                            <a href="{{ url('/login') }}">Login</a> <br />
                            <a href="{{ url('/password/reset') }}">Password Reset</a> <br />
                        </td>
                        <td>
                            <ul>                                                            
                                <li><a href="{{route('role.index')}}">role.index</a></li>
                                <li><a href="{{route('role.create')}}">role.create</a></li>
                                <li>role.store</li>
                                <li><a href="{{ route('role.show' , ['id' => 1]) }}">role.show/1</a></li>
                                <li><a href="{{ route('role.edit' , ['id' => 1]) }}">role.edit/1</a></li>
                                <li>role.update</li>
                                <li>role.destroy</li>
                            </ul>
                            <hr>
                            PERM_do_x
                        </td>
                        <td>
                            entry.index <a href="{{ route('rcadm.index') }}">Search</a> <br />
                            <a href="{{ route('rcadm.create') }}">entry.create</a> + pachet.create<br />
                            <a href="{{ route('rcadm.store') }}">entry.store</a> <br />
                            no show <br />
                            no edit <br />
                            no update <br />
                            <a href="{{ route('rcadm.destroy' , ['id' => 1]) }}">entry.destroy/id</a> <br />                           
                        </td>
                        <td>
                            <a href="{{ route('pachet.index') }}">pachet.index & api</a> <br />
                            pachet.create <a href="{{ route('pachet.create') }}">Json open</a><br />
                            no store <br />
                            <a href="{{ route('pachet.show' , ['id' => 1]) }}">etichete/id</a> <br />
                            no edit <br />
                            no update <br />
                            <a href="{{ route('pachet.destroy' , ['id' => 1]) }}">close/id</a> <br />    
                            <hr>                               
                            <a href="{{ route('pachet.show' , ['id' => 1]) }}">vezi/id</a> <br />
                        </td>                                  
                        <td>        
                            <a href="{{ route('scan.index') }}">HtmlTable</a> <br />
                            no create <br />
                            no store <br />
                            no show <br />
                            no edit <br />
                            <a href="{{ route('scan.update' , ['id' => 1]) }}">update cutie</a> <br />
                            no delete <br />
                            <hr>
                            <a href="genereaza_csv_xls/batch"  > Trimite </a> <br />
                            <a href="genereaza_csv_frumos_xls/batch"> Raport </a> <br /> 
                            <a href="arhiveaza_batch/batch"> Arhivare </a> <br />
                            <a href="genereaza_csv_xls_av/batch"> Arh.V </a> <br /> 
                            <a href="nu_export_csv/batch"> Export CSV </a> <br /> 
                            <a href="nu_export/batch"> Raport arhivare </a> <br /> 
                            <a href="nu_export_arhiveaza/batch"> Arhiveaza </a> 
                        </td>
                        <td>
                             <a href="{{ route('field.index') }}">HtmlTables ++</a> <br />
                             field.create <br />
                             <a href="{{ route('field.store') }}">field.store</a> <br />
                             no show <br />
                             <a href="{{ route('field.edit' , ['id' => 1]) }}">field.relate</a> <br />
                             <a href="{{ route('field.update' , ['id' => 1]) }}">field.update</a> <br />
                             <a href="{{ route('field.destroy' , ['id' => 1]) }}">delete/id ??</a> <br />
                        </td>
                    </tr>
                    <tr>
                        <th>
                            MIGRARE
                        </th>
                        <td colspan="5">
                            id_xls => id_entry <br />
                            cif int(10)<br />
                            id_aplicatie int(20) ??<br />
                            data_aprobare varchar(100) => data_aprobare (date) ?? <br />
                            cod_produs int(3) <br />
                            id_document	int(3) <br />
                            data_aplicatie varchar(255)=> data_aplicatie (date) ?? <br />
                            data_semnare date <br />
                            id_pachet varchar(255) => id_pachet int(11) !!! <br />
                            branch varchar(100) => branch varchar(3) <br />
                            doc_v varchar(100) => doc_v	varchar(20) <br />
                            batch varchar(20) => batch	int(10) !!! <br />
                            skp	varchar(11) => skp int(10) !!! <br />
                        </td>
                    </tr>
                </table>
        <br />
    </body>
</html>
