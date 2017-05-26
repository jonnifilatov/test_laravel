<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="main">
        <input name="_token" type="hidden" value="{{{ Session::getToken() }}}" />
        <button class="btn btn-default" name="add_task"><i class="glyphicon-plus"></i> Добавить композит</button>
        <table class="table" id="task_list">
            <thead>
                <tr>
                    <th>Название композита</th>
                </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </div>


    <div id="task_dialog" class="modal fade" aria-hidden="true"   >
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Добавить композит</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" checklist="" style="overflow: visible;">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-xs-5 control-label">Название</label>
                                <div class="col-xs-7">
                                    <input type="text" name="descr">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Закрыть</button>
                    <button class="btn btn-primary" name="save">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

        <!-- Scripts -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="/js/task_list.js"></script>
</body>
</html>
