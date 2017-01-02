<!DOCTYPE html>
<html>
    <head>
        <title>Lobby</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{URL::to('semantic/semantic.css')}}">
        <style>
            #game-area, #chat-area{
                height: 500px;
            }

            .container-buttons {
                position: absolute;
                bottom: 12px;
                width: 100%;
                text-align: center;
                z-index: 10;
            }

            .bullets {
              position: absolute;
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
                <div class="ui grid">
                    <div class="five wide column">
                        <div id="chat-area" class="ui segment">
                            <div id="chatContainer" style="height: 422px;overflow: auto; margin-bottom: 10px;">

                                    <div v-for="message in messages">@{{message.data}}</div>

                            </div>
                            <div class="ui fluid action input">
                                <input v-on:keyup.enter="sendMessage" v-model="message" type="text" placeholder="Write...">
                                <button @click="sendMessage" type="button" class="ui button">Send</button>
                            </div>
                        </div>
                    </div>
                    <div class="eleven wide column">
                        <div id="game-area" class="ui segment">
                            <div class="container-buttons" style="bottom: auto; top: 12px;">
                                <button ref="myBtn0" @click="fireDown(red, $event)" class="ui icon red button"><i class="arrow down icon"></i></button>
                                <button ref="myBtn1" @click="fireDown(orange, $event)" class="ui icon orange button"><i class="arrow down icon"></i></button>
                                <button ref="myBtn2" @click="fireDown(yellow,$event)" class="ui icon yellow button"><i class="arrow down icon"></i></button>
                                <button ref="myBtn3" @click="fireDown(olive,$event)" class="ui icon olive button"><i class="arrow down icon"></i></button>
                                <button ref="myBtn4" @click="fireDown(green,$event)" class="ui icon green button"><i class="arrow down icon"></i></button>
                                <button ref="myBtn5" @click="fireDown(teal,$event)" class="ui icon teal button"><i class="arrow down icon"></i></button>
                                <button ref="myBtn6" @click="fireDown(blue,$event)" class="ui icon blue button"><i class="arrow down icon"></i></button>
                                <button ref="myBtn7" @click="fireDown(violet,$event)" class="ui icon violet button"><i class="arrow down icon"></i></button>
                                <button ref="myBtn8" @click="fireDown(purple,$event)" class="ui icon purple button"><i class="arrow down icon"></i></button>
                                <button ref="myBtn9" @click="fireDown(pink,$event)" class="ui icon pink button"><i class="arrow down icon"></i></button>
                                <button ref="myBtn10" @click="fireDown(brown,$event)" class="ui icon brown button"><i class="arrow down icon"></i></button>
                                <button ref="myBtn11" @click="fireDown(grey,$event)" class="ui icon grey button"><i class="arrow down icon"></i></button>
                                <button ref="myBtn12" @click="fireDown(black,$event)" class="ui icon black button"><i class="arrow down icon"></i></button>
                            </div>
                            <div class="container-buttons">
                                <button @click="fire(red, $event, 'red')" class="ui icon red button"><i class="arrow up icon"></i></button>
                                <button @click="fire(orange,$event, 'orange')" class="ui icon orange button"><i class="arrow up icon"></i></button>
                                <button @click="fire(yellow,$event, 'yellow')" class="ui icon yellow button"><i class="arrow up icon"></i></button>
                                <button @click="fire(olive,$event, 'olive')" class="ui icon olive button"><i class="arrow up icon"></i></button>
                                <button @click="fire(green,$event, 'green')" class="ui icon green button"><i class="arrow up icon"></i></button>
                                <button @click="fire(teal,$event, 'teal')" class="ui icon teal button"><i class="arrow up icon"></i></button>
                                <button @click="fire(blue,$event, 'blue')" class="ui icon blue button"><i class="arrow up icon"></i></button>
                                <button @click="fire(violet,$event, 'violet')" class="ui icon violet button"><i class="arrow up icon"></i></button>
                                <button @click="fire(purple,$event, 'purple')" class="ui icon purple button"><i class="arrow up icon"></i></button>
                                <button @click="fire(pink,$event, 'pink')" class="ui icon pink button"><i class="arrow up icon"></i></button>
                                <button @click="fire(brown,$event, 'brown')" class="ui icon brown button"><i class="arrow up icon"></i></button>
                                <button @click="fire(grey,$event, 'grey')" class="ui icon grey button"><i class="arrow up icon"></i></button>
                                <button @click="fire(black,$event, 'black')" class="ui icon black button"><i class="arrow up icon"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <script src="{{URL::to('js/vue.js')}}"></script>
        <script src="{{URL::to('js/TweenMax.min.js')}}"></script>
        <script>
            var conn = new WebSocket('ws://brandonirs.com:5512');

            new Vue({
                el: "#app",
                data: {
                    messages: [],
                    message: '',
                    red: {
                        goodBullets: [],
                        badBullets: []
                    },
                    orange: {
                        goodBullets: [],
                        badBullets: []
                    },
                    yellow: {
                        goodBullets: [],
                        badBullets: []
                    },
                    olive: {
                        goodBullets: [],
                        badBullets: []
                    },
                    green: {
                        goodBullets: [],
                        badBullets: []
                    },
                    teal: {
                        goodBullets: [],
                        badBullets: []
                    },
                    blue: {
                        goodBullets: [],
                        badBullets: []
                    },
                    violet: {
                        goodBullets: [],
                        badBullets: []
                    },
                    purple: {
                        goodBullets: [],
                        badBullets: []
                    },
                    pink: {
                        goodBullets: [],
                        badBullets: []
                    },
                    brown: {
                        goodBullets: [],
                        badBullets: []
                    },
                    grey: {
                        goodBullets: [],
                        badBullets: []
                    },
                    black: {
                        goodBullets: [],
                        badBullets: []
                    }
                },
                methods: {
                  sendMessage() {
                      var mess = '{ "type" : "message", "data" : "' + this.message + '" }';
                      conn.send(mess);
                      this.messages.push({data: this.message});
                      this.message = '';
                      var chatCont = document.getElementById('chatContainer');
                      chatCont.scrollTop = chatCont.scrollHeight - chatCont.clientHeight;
                  },
                  fire(obj, e, color) {
                      conn.send('{ "type" : "bullet", "color" : "'+color+'"}');
                      var self = this;
                      var bullet = document.createElement('button');
                      var button = e.currentTarget;
                      var arrayBullets = obj.goodBullets;
                      bullet.className = button.className + ' bullets';
                      arrayBullets.push(bullet);
                      button.append(bullet);
                      TweenMax.set(bullet, {marginLeft: '-19px'});
                      TweenMax.to(bullet, 0.8, {top: '-438px', onComplete: function () {
                          arrayBullets.splice(0,1);
                          bullet.remove();
                      }, onUpdate: function () {
                          self.collision(obj);
                      }});
                  },
                    fireDown(obj, e) {
                        var bullet = document.createElement('button');
                        var button = e.currentTarget;
                        var arrayBullets = obj.badBullets;
                        bullet.className = button.className + ' bullets';
                        arrayBullets.push(bullet);
                        button.append(bullet);
                        TweenMax.set(bullet, {marginLeft: '-19px'});
                        TweenMax.to(bullet, 0.8, {top: '450px', onComplete: function () {
                            arrayBullets.splice(0,1);
                            bullet.remove();
                        }});
                    },
                    collision(obj) {
                        //console.log(this.goodBullets[0].getBoundingClientRect().top);
                        var goodArray = obj.goodBullets;
                        var badArray = obj.badBullets;
                        if(goodArray.length === 0 || badArray.length === 0) return;
                        var goodFirst = goodArray[0];
                        var badFirst = badArray[0];
                        var goodPosition = goodFirst.getBoundingClientRect();
                        var badPosition = badFirst.getBoundingClientRect();
                        if(goodPosition.top <= badPosition.top){
                            TweenMax.killTweensOf(goodFirst);
                            TweenMax.killTweensOf(badFirst);
                            goodArray.splice(0,1);
                            badArray.splice(0,1);
                            TweenMax.to(goodFirst, 0.6, {x: -100, opacity: 0, rotation: 390, y: 90, onComplete: function () {
                                goodFirst.remove();
                            }});
                            TweenMax.to(badFirst, 0.6, {x: 100, opacity: 0, rotation: -390, y: -90, onComplete: function () {
                                badFirst.remove();
                            }});
                        }
                    }
                },
                created() {
                    var self = this;
                    conn.onopen = function(e) {
                        console.log("Connection established!");
                    };

                    conn.onmessage = function(e) {
                        var data = JSON.parse(e.data);

                        switch (data.type) {
                            case 'message':
                                self.messages.push({data: data.data});
                            break;
                            case 'bullet':
                                switch (data.color) {
                                    case 'red':
                                        self.$refs.myBtn0.click();
                                        break;
                                    case 'orange':
                                        self.$refs.myBtn1.click();
                                        break;
                                    case 'yellow':
                                        self.$refs.myBtn2.click();
                                        break;
                                    case 'olive':
                                        self.$refs.myBtn3.click();
                                        break;
                                    case 'green':
                                        self.$refs.myBtn4.click();
                                        break;
                                    case 'teal':
                                        self.$refs.myBtn5.click();
                                        break;
                                    case 'blue':
                                        self.$refs.myBtn6.click();
                                        break;
                                    case 'violet':
                                        self.$refs.myBtn7.click();
                                        break;
                                    case 'purple':
                                        self.$refs.myBtn8.click();
                                        break;
                                    case 'pink':
                                        self.$refs.myBtn9.click();
                                        break;
                                    case 'brown':
                                        self.$refs.myBtn10.click();
                                        break;
                                    case 'grey':
                                        self.$refs.myBtn11.click();
                                        break;
                                    case 'black':
                                        self.$refs.myBtn12.click();
                                        break;
                                }
                            break;
                        }
                    };
                },
                mounted() {
                    /*var elem = this.$refs.myBtn;
                    var elem1 = this.$refs.myBtn1;
                    var elem3 = this.$refs.myBtn3;
                    var elem6 = this.$refs.myBtn6;
                    var elem12 = this.$refs.myBtn12;
                    setInterval(function () {
                        elem.click();
                    }, 500);

                    setInterval(function () {
                        elem1.click();
                    }, 400);

                    setInterval(function () {
                        elem3.click();
                    }, 600);

                    setInterval(function () {
                        elem6.click();
                    }, 200);

                    setInterval(function () {
                        elem12.click();
                    }, 1000);*/
                }
            });
        </script>
    </body>
</html>
