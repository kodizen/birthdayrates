<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Birthday Rates</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        
    </head>
    <body>
       <h1>Birthday Rates</h1>

        @if (count($birthdays) > 0)
            {{ $birthdays}}
        @else 
            <p>Sorry, no birthdays have been submitted yet :(</p>
        @endif
      
    </body>
</html>
