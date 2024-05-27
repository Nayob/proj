<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=alegreya-sans-sc:300,400,500,700" rel="stylesheet" />

        <!-- Styles -->
        <style>
            * {
                margin: 0;
                padding: 0;
            }
            body, html {
                height: 100%;
                position: relative;
                background-color: #1f1f1e;
            }
            .centered-div {
                width: 400px;
                height: 400px;
                background-color: #565656;
                padding: 15px;
                
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .input-label {
                color: #feac66;
                font-family: 'Alegreya Sans SC', sans-serif;
                font-size: small;
            }

            input {
                width: inherit;
                line-height: 25px;
                border: solid 0px #424769;
                border-radius: 3px;
                background-color: #fcf3e4;
                text-color: white;
                font-family: 'Alegreya Sans SC', sans-serif;
                padding: 0px 5px;
                
            }
            *:focus {
                outline: none;
            }
            textarea:focus, input:focus{
                border: solid 1px white;
            }
            .input-group {
                padding: 10px 0px;
                width: 100%;
            }

            .red {
                color: red;
            }

        </style>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="centered-div">
            <form action="/api/upload" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <p class="input-label">name</p>
                    <input type="text" name="name" value="" required="'required'">
                    @error('name')
                        <div class="input-label red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group">
                    <p class="input-label">email</p>
                    <input type="email" name="email" value="" placeholder="email@email.com" required="'required'">
                    @error('email')
                        <div class="input-label red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group">
                    <p class="input-label">phone</p>
                    <input type="tel" name="phone" value="" placeholder="+7 (000) 000-00-00">
                    @error('phone')
                        <div class="input-label red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group">
                    <p class="input-label">avatar</p>
                    <input type="file" name="avatar">
                    @error('avatar')
                        <div class="input-label red">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group">
                    <input type="submit" value="Submit">
                </div>
            </form>
            <!-- {{phpinfo()}} -->
        </div>
    </body>
</html>
