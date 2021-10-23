<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/chat.css')}}">
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.4/css/pro.min.css" rel="stylesheet">
    <link rel="icon" href="{{asset('img/monkey.png')}}" type="image/png">
    <title>MonkeChat</title>
    @livewireStyles
  </head>
  <body style="padding-right: 0 !important;">
    
    <div class="container px-0">
        @yield('content')
    </div>


    @livewireScripts
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      $(window).on('focus', function () {
        $('#online-poll').attr('wire:poll.1000ms', 'update_unseen');
      });

      $(window).on('blur', function () {
        $('#online-poll').removeAttr('wire:poll.1000ms');
      });
    </script>

    <script>
      window.addEventListener('scrollDown', event =>{
        var objDiv = document.getElementById("chat-box-messages");
        objDiv.scrollTop = objDiv.scrollHeight;
      })
      
    </script>

    <script>
      $('body').on('DOMSubtreeModified', '#chat-box-messages', function(){
        var objDiv = document.getElementById("chat-box-messages");
        objDiv.scrollTop = objDiv.scrollHeight;
      });
    </script>

    <script>
      window.addEventListener('showUserPhoto', event =>{
        $('#userFoto').modal('show');
      })
    </script>

  </body>
</html>