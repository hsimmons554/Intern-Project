<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    @foreach($tasks as $task)
      <li>
        <a href="/tasks/{{$task->id}}">
           {{$task->body}}
         </a>
       </li>
    @endforeach
  </body>
</html>
