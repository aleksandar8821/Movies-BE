<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
   @foreach($movies as $movie)
   {{$movie->name}} <br>

   @endforeach


   
    {{ $movies->links() }}


</body>
</html>
                   
