var previous_command = "";
$(document).ready(function() {

  function generateRandomString(length) {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_:\'|~";

  for (var i = 0; i < length; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}
function generateRandomHash() {
  var hashArray = [
"kxs3Y::A5304DAD162CCB5EE84ACFEC03001A78:F2E4C2E937AB5B3DCC1F88855173695D:::",
"V3hIdsf8P::6A9CF8C0398D2C00CBE983917D2409CC:010901929BF198C67DF7049E74A8F1A3:::",
"vg4zgdsBp::A200D0BC980DEEB02F891D1A18853BEB:41D39DBBD96EC3D5303034F49A11B9BC:::",
"4qUsdffi6::F9D3E03CAEFC388EA4318E987934587F:8F678EFBB822AFD263F4686883721450:::",
"QqaPRkkE::4D07CF9AEB94BE91DA355BF2BC3D97E9:B74968C66B89F9CECDCE58B8FDC9FEA4:::",
"ZzJfdsgQ6m::962F67AB4D074D61DDB780C743F95EE5:D96E6E8FC073F2903AB5B5EC78CE6FB0:::",
"3j80kfdsOjK::AB7B1FBB4BA2ECBBF27FE9B7D2C64DF9:F4971289C66FF38307D8B57637F7A21D:::",
"sMxgVsAR9sCw::6EA861840698938989C0FE3D8291A67E:56A5E6C8EF937B15D176DFE133176027:::",
"RVfTasmoAY1::09B6DDA2C239389EC3F79861CAC60C64:45DF37BE97BAD204674DD8CDA5B7CAEA:::",
"EcgbqAz::5639B7B48A32E842E79BB1AC8DAC8C09:2BDF5EAF79C0420B33E53E71B094B595:::",
"ff43fdu0::BC3AB20EFB3974C39F11AB651A0BACD1:015D198B94EC5CD17E759F618FE178E7:::",
"VdgnH::2B7DD8AB535CF75F30144FB3B9F491CE:1B19669068943A5CE90C2DD19C9B5DC2:::",
"bs8pzX::C092659279B6E827E52BADE84872079A:A7DEB3259C4D10F89AF1DF20E39EA8A0:::",
"3lC3t::09F892C03EAD5F60B54DFF18C8BBE6BA:417E8C13D9B471200CAB925F3DDFFEA9:::",
"admin::F0D412BD764FFE81AAD3B435B51404EE:209C6174DA490CAEB422F3FA5A7AE634:::"];
return hashArray[Math.floor(Math.random()*hashArray.length)];
}
  var divx = document.getElementById('terminal');

  /* Welcome screen */
  $('#welcome-login').animate({'opacity': '1', 'top': $(window).height()/2 - $('#welcome-login').height()/2 }, 3000);

  setTimeout(function() {
      $('#login-input').animate({'opacity': '1'}, 3000);
  }, 4000);

  /* player login */
  var player_name = "Anonymous";
  var logged = 0;

  $('#login-input').keypress(function(e) {
    if(e.which === 13 && $(this).val() != '') {
      player_name = escape($(this).val());
      logged = 1;
      $('#welcome-login').animate({'opacity': '0'}, 1000);
      /* objectives */
      var a = 0;
      var help = 0;
      var list = 0;
      var connect = 0;
      var scan = 0;
      var scan_web = 0;
      var scan_vuln = 0;
      var trojan = 0;
      var disconnect = 0;

      var won = 0;
      var able = 0;

      window.setInterval(function() {
        $("#terminal").scrollTop($("#terminal")[0].scrollHeight);
        if (won === 0) {
          if (help === 1) {
            $('#objectives #help').css({'color': 'red'});
            $('#objectives #list').animate({'opacity': '1'}, 1000);
            if (list === 1) {
              $('#objectives #list').css({'color': 'red'});
              $('#objectives #scan').animate({'opacity': '1'}, 1000);


              if (scan === 1) {
                $('#objectives #scan').css({'color': 'red'});
                $('#objectives #scan_vuln').animate({'opacity': '1'}, 1000);
                if (scan_web === 1) {
                  $('#objectives #scan_vuln').css({'color': 'red'});
                  $('#objectives #hack').animate({'opacity': '1'}, 1000);
                  if (connect === 1) {
                    $('#objectives #hack').css({'color': 'red'});
                    $('#objectives #trojan').animate({'opacity': '1'}, 1000);
                    $('#objectives #trojan2').animate({'opacity': '1'}, 1000);

                  if (trojan === 1) {
                  $('#objectives #trojan').css({'color': 'red'});
                  $('#objectives #disconnect').animate({'opacity': '1'}, 1000);
                }}
                }
              }
            }
          }
        }



        if (disconnect === 1) {
          $('#objectives #disconnect').css({'color': 'red'});
        }

        if (minutes <= 1 && help === 1 && list === 1 && connect === 0 && trojan === 1 && disconnect === 1) {
          won++;
        }

        if (won === 1) {
          $('#objectives li').animate({'opacity': '0'}, 3000);
          $('#objectives #won').show(3000).animate({'opacity': '1'}, 3000);
        } else if (won > 1) {
          won = 2;
        }
      }, 1000);

      /* timer */
      var seconds = 0;
      var minutes = 0;
      var danger = 0;
      var lost = 0;

window.setInterval(function() {
      if (trojan === 1) {

        if ((a%16)==0){
          $('#terminal').append('<br>');
        }
        if (a==128){
          $('#terminal').append('Hi Jersey! I would like to inform you...~Jh7$^PlKp3%bgW1lNT<br>');
        }
        if (a==256){
          $('#terminal').append('C:\\users\\Administrator\\Desktop\\....~Jh7$^PlKp3%bgW1lNT<br>');
        }
        if ((a>512) && (a%128)==0){
          $('#terminal').append(generateRandomHash()+"<br>");
        }

        a++;
        $('#terminal').append(generateRandomString(3));
      }
}, 30);

      window.setInterval(function() {

        if (connect === 1) {
          if (seconds < 10) {
            $('#time').text('Being traced: ' + minutes + ':0' +seconds + '  ');
          } else {
            $('#time').text('Being traced: ' + minutes + ':' +seconds + '  ');
          }
          if (seconds < 59) {
            seconds++;
          } else {
            seconds = 0;
            minutes++;
          }
          if (minutes >= 0 && seconds > 45) {
            $('#time').css({'color': 'red'});
            danger++;
          }
          if (danger === 1) {
            $('span').remove();
            $('#terminal').append('<div>You have only 15 seconds left...<span id="blinking">_</span></div><br>');
            divx.scrollTop = divx.scrollHeight;
          } else if (danger > 1) {
            danger = 2;
          }
          if (minutes >= 1 && seconds > 0) {
            $('#time').text('You\'ve been traced down!');
            lost++;
            able = 0;
          }
          if (lost === 1) {
            $('span').remove();
            $('#terminal').append('<div>You\'ve been traced down!<br>Formatting HDD...<br>Goodbye...<span id="blinking">_</span></div><br>');
            $('#objectives li').animate({'opacity': '0'}, 3000);
            $('#objectives #lost').show(3000).animate({'opacity': '1'}, 3000);
            divx.scrollTop = divx.scrollHeight;
            $('#objectives li').css({'color': 'green'}).animate({'opacity': '1'}, 3000);
            setTimeout(function() {
              $('#terminal').animate({'opacity': '0'}, 1000);
              $('#root').animate({'opacity': '0'}, 1000);
              $('input').animate({'opacity': '0'}, 1000).hide(3000);
              $('#objectives').animate({'opacity': '0'}, 1000);
              $('#time').animate({'opacity': '0'}, 1000);
              help = 0;
              list = 0;
              connect = 0;
              trojan = 0;
              disconnect = 0;
              won = 0;
              $('#objectives li').css({'color': 'green'});
            }, 20000);
          } else if (lost > 1) {
            lost = 2;
          }
        }
      }, 1000);

      setTimeout(function(){
        $('#terminal').animate({'opacity': '1'}, 1000);
      }, 1000);

      setTimeout(function(){
        $('#root').animate({'opacity': '1'}, 1000);
        $('input').animate({'opacity': '1'}, 1000).show();
      }, 5000);

      setTimeout(function(){
        $('span').remove();
        $('#terminal').append('<br><div>Welcome to HACKSYS [version 1.0.0].<br>(c) Copyright 2014 HACorp Corporation. All rights reserved.<br><br>' + player_name + ' authenticated.<br>HACKSYS ready for use.<br>Use the help command for a list of commands.<br><br><span id="initial-root">$</span>&nbsp;&nbsp;&nbsp;<span id="blinking">_</span></div>');
      }, 6500);

      setTimeout(function() {
        $('#time').animate({'opacity': '1'}, 3000);
        $('#objectives').animate({'opacity': '1'}, 3000);
      }, 7000);

      setTimeout(function() {
        $('#objectives #help').animate({'opacity': '1'}, 500);
        able = 1;
      }, 10000);

      function checkKey(e) {

               if(e.which === 38 && $('#input').val() === ''){
                 
                 $('#input').val(previous_command);

               }}
  document.onkeydown = checkKey;
      $('#input').keypress(function(e) {
          if(e.which === 13 && $(this).val() != '' && able === 1) {
            previous_command = $(this).val();
            $('div span').remove();
            $('initial-root').remove();

            /*
             * List of commands available in the game:
             *
             * help
             * list
             * connect nearest-phone-relay
             * send trojan
             * send adware
             * disconnect
             * exit
             * nmap
             *
             *
             */

            switch( $(this).val() ) {
              case 'help':
                $('#terminal').append('<div>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>List of commands:<br>\
                help - Show this message (command list)<br>\
                connect [ip:port] - Connects host computer to open port<br>\
                disconnect - Disconnects from the connected host<br>\
                exit - Shuts down host computer<br>nmap - Scan host for open ports [nmap host]<br>\
                nikto [ip:port] - Web application vulnerability scanner<br>\
                exploit [vulnerability] - Run exploit to hack the server<br>\
                list - Shows the list of the currently available applications<br>\
                send [application type] - Sends given application name to the connected DNS name<span id="blinking">_</span></div>');
                help = 1;
                break;
              case 'nmap bank.com':
                  $('#terminal').append('<div>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>Starting Nmap 7.80 ( https://nmap.org )...<br>');

                    setTimeout(function() {
                      $('#terminal').append('<div>Nmap scan report for bank.com (13.37.13.37).<br>PORT     STATE SERVICE<br>80/tcp  open  http<br>445/tcp  open  microsoft-ds<br>548/tcp  open  afp<br>Nmap done: 1 IP address (1 host up) scanned in 3.84 seconds<br><span id="blinking">_</span></div>');
                      scan = 1;
                    }, 4000);


                break;

              case 'nikto':
               $('#terminal').append('<br><div>Missing host and port<br>nikto ip:port<span id="blinking">_</span></div>');
               break;

              case 'nikto 13.37.13.37:80':
              $('#terminal').append('<div>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>[!] Nikto v2.1.6');
                setTimeout(function() {
                  $('#terminal').append('<div>[+] Vulnerability found for bank.com (13.37.13.37)<br>Cookie without HTTPonly flag. Exploit: unavailable</div>');
                }, 1000);
                setTimeout(function() {
                  $('#terminal').append('<br><div>[+] Vulnerability found for bank.com (13.37.13.37)<br>Remote Code Execution. Exploit: RCE</div>');
                }, 5000);
                setTimeout(function() {
                  $('#terminal').append('<br><div>[+] Vulnerability found for bank.com (13.37.13.37)<br>SQL injection. Exploit: SQLi</div>');
                }, 8000);
                setTimeout(function() {
                  $('#terminal').append('<br><div>[!] Scan completed in 9.89 seconds<br>[0] exploit RCE<br>[1] exploit SQLi<br><span id="blinking">_</span></div>');
                  scan_web = 1;
                }, 12000);
                break;

              case 'exploit RCE':

                  if (scan_web === 1) {
                    if (connect === 0) {
                    $('#terminal').append('<div>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>Trying to hack 13.37.13.37:80 with Remote Code Execution');
                      setTimeout(function() {
                        $('#terminal').append('[+] Connection with bank.com (13.37.13.37) established</div>');
                      }, 1000);
                      setTimeout(function() {
                        $('#terminal').append('<br>[+] Sending RCE payload...</div>');
                      }, 2000);
                      setTimeout(function() {
                        $('#terminal').append('<br>[-] Timeout. Second connection...</div>');
                      }, 8000);
                      setTimeout(function() {
                        $('#terminal').append('<br>[+] Exploiting...</div>');
                      }, 8500);
                      setTimeout(function() {
                        $('#terminal').append('<br>[+] Exploited! You are in!<br>You have 1 minute before you get traced down.<span id="blinking">_</span></div>');
                        connect = 1;
                      }, 12000);
                    }else {
                        $('#terminal').append('<br>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>You have already exploited 13.37.13.37.<span id="blinking">_</span></div>');
                      }

                  }else {
                      $('#terminal').append('<br>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>You don\'t have exploits ready to launch.<span id="blinking">_</span></div>');
                    }
                break;

              case 'exploit SQLi':

                  if (scan_web === 1) {
                    if (connect === 0) {
                    $('#terminal').append('<div>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>Trying to hack 13.37.13.37:80 with SQLmap');
                      setTimeout(function() {
                        $('#terminal').append('[+] Connection with bank.com (13.37.13.37) established</div>');
                      }, 1000);
                      setTimeout(function() {
                        $('#terminal').append('<br>[+] Enumerating payloads...</div>');
                      }, 1100);
                      setTimeout(function() {
                        $('#terminal').append('<br>[-] \' or 1=1 ...</div>');
                      }, 1500);
                      setTimeout(function() {
                        $('#terminal').append('<br>[-] \' order by 8 ...</div>');
                      }, 1600);
                      setTimeout(function() {
                        $('#terminal').append('<br>[-] \' order by 9 ...</div>');
                      }, 2000);
                      setTimeout(function() {
                        $('#terminal').append('<br>[+] \' UNION SELECT</div>');
                      }, 2500);
                      setTimeout(function() {
                        $('#terminal').append('<br>[+] Exploited! You are in!<br>You have 1 minute before you get traced down.<span id="blinking">_</span></div>');
                        connect = 1;
                      }, 3000);
                    }else {
                        $('#terminal').append('<br>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>You have already exploited 13.37.13.37.<span id="blinking">_</span></div>');
                      }

                  }else {
                      $('#terminal').append('<br>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>You don\'t have exploits ready to launch.<span id="blinking">_</span></div>');
                    }
                break;


              case 'list':
                $('#terminal').append('<div>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>List of currently available applications:<br>\
                AdBreak - bombard targeted computer with advertisement pop-ups (type: adware)<br>\
                Trojan.Vitalik.AAA - steals vital information from the targeted computer (type: trojan)<span id="blinking">_</span>');
                list = 1;
                break;

              case 'send trojan':
                if (connect === 1) {
                  $('#terminal').append('<div>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>Sending Trojan.Vitalik.AAA...<span id="blinking">_</span></div>');
                    setTimeout(function() {
                      $('#terminal').append('<br>TTrojan.Vitalik.AAA sent.<br>Sniffing for creds...');
                      trojan = 1;
                    }, 1200);
                } else {
                  $('#terminal').append('<div>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>You are not connected to any DNS name.<span id="blinking">_</span></div>');
                }
                break;
              case 'send adware':
                if (connect === 1) {
                  $('#terminal').append('<div>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>Sending AdBreak...<br>Unable to send AdBreak.<span id="blinking">_</span></div>');
                } else {
                  $('#terminal').append('<div>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>You are not connected to any DNS name.<span id="blinking">_</span></div>');
                }
                break;
        case 'connect 13.37.13.37:445':
            $('#terminal').append('<div>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>Enter username and password -> connect 13.37.13.37:445 -u -p');
        break;
        case 'connect 13.37.13.37:445 -u admin -p admin':
        $('#objectives #troyan2').css({'color': 'red'});
        $('#terminal').append('<div>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>FLAG{Welcome_to_HACKSYS_the_hacking_game}');

        break;

              case 'disconnect':
                if (connect === 1) {
                  $('#terminal').append('<div>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>Disconnecting...<br>Disconnected<span id="blinking">_</span></div>');
                  disconnect = 1;
                  connect = 0;
                  minutes = 0;
                  seconds = 0;
                  trojan = 0;
                  a = 0;
                } else {
                  $('#terminal').append('<div>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>You are not connected to any host.<span id="blinking">_</span></div>');
                }
                break;
              case 'exit':
                $('#terminal').animate({'opacity': '0'}, 1000);
                $('#root').animate({'opacity': '0'}, 1000);
                $('input').animate({'opacity': '0'}, 1000).hide(3000);
                $('#objectives').animate({'opacity': '0'}, 1000);
                $('#time').animate({'opacity': '0'}, 1000);
                help = 0;
                list = 0;
                connect = 0;
                trojan = 0;
                disconnect = 0;
                won = 0;
                $('#objectives li').css({'color': 'green'});
                break;
              default:
                $('#terminal').append('<div>$&nbsp;&nbsp;&nbsp;' + $(this).val() + '<br>Command not recognized. Type in help for a list of commands.<span id="blinking">_</span></div>');
            }
            $('#terminal').append('<br>');

            divx.scrollTop = divx.scrollHeight;
            $(this).val('');
          }
      });
    }
  });




});
