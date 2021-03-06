<html>
<head>
    <title>Kernel Error</title>
    <style>*{transition:all .6s}html{height:100%}body{font-family:Lato,sans-serif;margin:0;background-color:#0073e6;color:#fff}#main{display:table;width:100%;height:100vh;text-align:center}.fof{display:table-cell;vertical-align:middle}.fof h1{font-size:50px;display:inline-block;padding-right:12px;animation:type .5s alternate infinite}@keyframes type{from{box-shadow:inset -3px 0 0 #fff}to{box-shadow:inset -3px 0 0 transparent}}</style>
    <link rel="icon" type="image/x-icon" href="/resources/icons/favicon.ico">
</head>
<body>
<div id="main">
    <div class="fof">
        <h1>Exception</h1>
        <small>DTH Labs ALPHA</small>
        <br/>
        <small>{{$error}}
        <small><b>{{$file}}</b></small>
        <br/>
        {{$stack}}
        </small>
    </div>
</div>
</body>
</html>