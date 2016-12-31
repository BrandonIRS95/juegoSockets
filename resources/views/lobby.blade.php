<!DOCTYPE html>
<html>
    <head>
        <title>Lobby</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{URL::to('semantic/semantic.css')}}">
        <style>
            #game-area{
                height: 500px;
            }

            .container-buttons {
                position: absolute;
                bottom: 12px;
                width: 100%;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <div class="ui container">
                <div class="ui segment">
                    <h2 class="ui header">
                        <i class="plug icon"></i>
                        <div class="content">
                            Test Game
                        </div>
                    </h2>
                </div>
                <div class="ui segment">
                    <div class="ui grid">
                        <div class="four wide column">
                            <ul class="ui list" style="height: 450px; overflow-y: auto; padding-left: 18px;">
                                <li v-for="message in messages">@{{message.data}}</li>
                            </ul>
                            <div class="ui action input">
                                <input v-on:keyup.enter="sendMessage" v-model="message" type="text" placeholder="Write...">
                                <button @click="sendMessage" type="button" class="ui button">Send</button>
                            </div>
                        </div>
                        <div class="twelve wide column">
                            <div id="game-area" class="ui segment">
                                <div class="container-buttons">
                                    <button class="ui icon red button"><i class="arrow up icon"></i></button>
                                    <button class="ui icon orange button"><i class="arrow up icon"></i></button>
                                    <button class="ui icon yellow button"><i class="arrow up icon"></i></button>
                                    <button class="ui icon olive button"><i class="arrow up icon"></i></button>
                                    <button class="ui icon green button"><i class="arrow up icon"></i></button>
                                    <button class="ui icon teal button"><i class="arrow up icon"></i></button>
                                    <button class="ui icon blue button"><i class="arrow up icon"></i></button>
                                    <button class="ui icon violet button"><i class="arrow up icon"></i></button>
                                    <button class="ui icon purple button"><i class="arrow up icon"></i></button>
                                    <button class="ui icon pink button"><i class="arrow up icon"></i></button>
                                    <button class="ui icon brown button"><i class="arrow up icon"></i></button>
                                    <button class="ui icon grey button"><i class="arrow up icon"></i></button>
                                    <button class="ui icon black button"><i class="arrow up icon"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{URL::to('js/vue.js')}}"></script>
        <script>
            var conn = new WebSocket('ws://localhost:8080');

            new Vue({
                el: "#app",
                data: {
                    messages: [],
                    message: ''
                },
                methods: {
                  sendMessage() {
                      conn.send(this.message);
                      this.messages.push({data: this.message});
                      this.message = '';
                  }
                },
                created() {
                    var self = this;
                    conn.onopen = function(e) {
                        console.log("Connection established!");
                    };

                    conn.onmessage = function(e) {
                        self.messages.push({
                            data: e.data
                        })
                    };
                }
            });
        </script>
    </body>
</html>