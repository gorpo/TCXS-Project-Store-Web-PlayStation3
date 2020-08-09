<?php
// para iniciar esta sessao é necessario usar o link https://tcxsproject.com.br/store/consulta.php?act=tcxs
session_start();
if (!$_REQUEST["act"] && $_REQUEST["act"] != "tcxs"){
  header('Location: nao_logado.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = filter_input(INPUT_POST, 'usuario');
} 

// Cria a conexão com o banco de dados
try {
    $conexao = new PDO("mysql:host=localhost;dbname=users_tcxs", "root", "");
    //$conexao = new PDO("mysql:host=localhost;dbname=u923273795_users", "u923273795_users", "Tcxsproject2020web");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "<p class=\"bg-danger\">Erro na conexão:" . $erro->getMessage() . "</p>";
}

// Bloco if que recupera as informações no formulário, etapa utilizada pelo Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $usuario != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM $usuario");
        //$stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $usuario = $rs->usuario;
            $senha = $rs->senha;
            $ip = $rs->ip;
            $data_atual = $rs->data_atual;
        } else {
            echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
        }
    } catch (PDOException $erro) {
        echo "<p class=\"bg-danger\">Caso usuário ainda não tenha realizado o login não teremos dados para consultar, espere ate que o usuário logue e tente novamente!</p>";
    }
}

?>


<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!-- css e js do painel -->
<script type="text/javascript">
document.oncontextmenu =new Function("return false;")
document.onselectstart =new Function("return false;")
</script>
  <link href="assets/css/bootstrap.css" type="text/css" rel="stylesheet" />
<script src="assets/js/bootstrap.js" type="text/javascript" ></script>

    <body background-image: src("http://i.imgur.com/NGKTTJE.jpg")> <link rel="SHORTCUT ICON" href="https://i.imgur.com/OyZ2Wia.png" type="image/x-icon" />

    <style type="text/css">
        body {
            background-image: url("http://i.imgur.com/NGKTTJE.jpg");
            background-repeat: no-repeat;
            background-size: 100%;
        }

    </style>

    <script type="text/javascript">
        var rev = "fwd";

        function titlebar(val) {
            var msg = "TCXS Project";
            var res = " ";
            var speed = 50
            var pos = val;

            msg = "|" + msg + " |";
            var le = msg.length;
            if (rev == "fwd") {
                if (pos < le) {
                    pos = pos + 1;
                    scroll = msg.substr(0, pos);
                    document.title = scroll;
                    timer = window.setTimeout("titlebar(" + pos + ")", speed);
                } else {
                    rev = "bwd";
                    timer = window.setTimeout("titlebar(" + pos + ")", speed);
                }
            } else {
                if (pos > 0) {
                    pos = pos - 1;
                    var ale = le - pos;
                    scrol = msg.substr(ale, le);
                    document.title = scrol;
                    timer = window.setTimeout("titlebar(" + pos + ")", speed);
                } else {
                    rev = "fwd";
                    timer = window.setTimeout("titlebar(" + pos + ")", speed);
                }
            }
        }

        titlebar(0);

    </script>


    <style type="text/css">
        background: black url('https://wallpaper-house.com/data/out/9/wallpaper2you_321733.jpg');
        scroll repeat center center;
        background-repeat:fixed;
        color: #66FF00;

        a:hover {
            cursor: url(http://indiaonlineeducation.com/wp//wp-content/uploads/2016/u3k00+emxZu8gUkpvvrPArYuL2wjd5Uivs00URqddIM=.swf), progress !important;
        }

        h1 {
            color: #370909;
            font-size: 50px;
            margin: 1px auto;
            text-align: center;
            text-transform: uppercase;
            font-family: Orbitron;
        }

        .neon {
            color: #370909;
            text-shadow: 0 0 5px #b90303, 0 0 10px #b90303, 0 0 30px #c92626, 0 0 45px #c92626, 0 0 60px #c92626;
        }


        h2 {
            color: #370909;
            font-size: 50px;
            margin: 1px auto;
            text-align: center;
            text-transform: uppercase;
            font-family: Orbitron;
        }

        .neon {
            color: #370909;
            text-shadow: 0 0 5px #b90303, 0 0 10px #b90303, 0 0 30px #c92626, 0 0 45px #c92626, 0 0 60px #c92626;
        }

        h3 {
            color: #370909;
            font-size: 50px;
            margin: 1px auto;
            text-align: center;
            text-transform: uppercase;
            font-family: Orbitron;
        }

        .neon {
            color: #370909;
            text-shadow: 0 0 5px #b90303, 0 0 10px #b90303, 0 0 30px #c92626, 0 0 45px #c92626, 0 0 60px #c92626;
        }


        h4 {
            color: #FF0000;
            font-size: 20px;
            margin: 1px auto;
            text-align: center;
            text-transform: uppercase;
            font-family: Orbitron;
        }

        .neon {
            color: #370909;
            text-shadow: 0 0 5px #b90303, 0 0 10px #b90303, 0 0 30px #c92626, 0 0 45px #c92626, 0 0 60px #c92626;
        }


        .matrix {
            color: #370909;
            font-family: Arial, Courier, Monotype;
            font-size: 10pt;
            text-align: center;
            width: 10px;
            padding: 0px;
            margin: 0px;
        }

        .jokitz1 {
            text-align: center;
        }

        .jokitz2 {
            text-align: center;
            font-family: Courier;
        }

        img:hover {
            animation: shake 0.5s;
            animation-iteration-count: infinite;
        }

        @keyframes shake {
            0% {
                transform: translate(1px, 1px) rotate(0deg);
            }

            10% {
                transform: translate(-1px, -2px) rotate(-1deg);
            }

            20% {
                transform: translate(-3px, 0px) rotate(1deg);
            }

            30% {
                transform: translate(3px, 2px) rotate(0deg);
            }

            40% {
                transform: translate(1px, -1px) rotate(1deg);
            }

            50% {
                transform: translate(-1px, 2px) rotate(-1deg);
            }

            60% {
                transform: translate(-3px, 1px) rotate(0deg);
            }

            70% {
                transform: translate(3px, 1px) rotate(-1deg);
            }

            80% {
                transform: translate(-1px, -1px) rotate(1deg);
            }

            90% {
                transform: translate(1px, 2px) rotate(0deg);
            }

            100% {
                transform: translate(1px, -2px) rotate(-1deg);
            }
        }

    </style>
    <script type="text/javascript" language="javascript">
<!--

var rows=1; // must be an odd number

var speed=10; // lower is faster

var reveal=2; // between 0 and 2 only. The higher, the faster the word appears

var effectalign="center" //enter "center" to center it.

var w3c=document.getElementById && !window.opera;;

var ie45=document.all && !window.opera;

var ma_tab, matemp, ma_bod, ma_row, x, y, columns, ma_txt, ma_cho;

var m_coch=new Array();

var m_copo=new Array();

window.onload=function() {

  if (!w3c && !ie45) return

  var matrix=(w3c)?document.getElementById("matrix"):document.all["matrix"];

  ma_txt=(w3c)?matrix.firstChild.nodeValue:matrix.innerHTML;

  ma_txt=" "+ma_txt+" ";

  columns=ma_txt.length;

  if (w3c) {

    while (matrix.childNodes.length) matrix.removeChild(matrix.childNodes[0]);

    ma_tab=document.createElement("table");

    ma_tab.setAttribute("border", 0);

    ma_tab.setAttribute("align", effectalign);

    ma_tab.style.backgroundColor="#000000";

    ma_bod=document.createElement("tbody");

    for (x=0; x<rows; x++) {

      ma_row=document.createElement("tr");

      for (y=0; y<columns; y++) {

        matemp=document.createElement("td");

        matemp.setAttribute("id", "Mx"+x+"y"+y);

        matemp.className="matrix";

        matemp.appendChild(document.createTextNode(String.fromCharCode(160)));

        ma_row.appendChild(matemp);

      }

      ma_bod.appendChild(ma_row);

    }

    ma_tab.appendChild(ma_bod);

    matrix.appendChild(ma_tab);

  } else {

    ma_tab='<ta'+'ble align="'+effectalign+'" border="0" style="background-color:#000000">';

    for (var x=0; x<rows; x++) {

      ma_tab+='<t'+'r>';

      for (var y=0; y<columns; y++) {

        ma_tab+='<t'+'d class="matrix" id="Mx'+x+'y'+y+'"> </'+'td>';

      }

      ma_tab+='</'+'tr>';

    }

    ma_tab+='</'+'table>';

    matrix.innerHTML=ma_tab;

  }

  ma_cho=ma_txt;

  for (x=0; x<columns; x++) {

    ma_cho+=String.fromCharCode(32+Math.floor(Math.random()*94));

    m_copo[x]=0;

  }

  ma_bod=setInterval("mytricks()", speed);

}



function mytricks() {

  x=0;

  for (y=0; y<columns; y++) {

    x=x+(m_copo[y]==100);

    ma_row=m_copo[y]%100;

    if (ma_row && m_copo[y]<100) {

      if (ma_row<rows+1) {

        if (w3c) {

          matemp=document.getElementById("Mx"+(ma_row-1)+"y"+y);

          matemp.firstChild.nodeValue=m_coch[y];

        }

        else {

          matemp=document.all["Mx"+(ma_row-1)+"y"+y];

          matemp.innerHTML=m_coch[y];

        }

        matemp.style.color="#81F2FF";

        matemp.style.fontWeight="bold";

      }

      if (ma_row>1 && ma_row<rows+2) {

        matemp=(w3c)?document.getElementById("Mx"+(ma_row-2)+"y"+y):document.all["Mx"+(ma_row-2)+"y"+y];

        matemp.style.fontWeight="normal";

        matemp.style.color="#00BBFF";

      }

      if (ma_row>2) {

          matemp=(w3c)?document.getElementById("Mx"+(ma_row-3)+"y"+y):document.all["Mx"+(ma_row-3)+"y"+y];

        matemp.style.color="#b00606";

      }

      if (ma_row<Math.floor(rows/2)+1) m_copo[y]++;

      else if (ma_row==Math.floor(rows/2)+1 && m_coch[y]==ma_txt.charAt(y)) zoomer(y);

      else if (ma_row<rows+2) m_copo[y]++;

      else if (m_copo[y]<100) m_copo[y]=0;

    }

    else if (Math.random()>0.9 && m_copo[y]<100) {

      m_coch[y]=ma_cho.charAt(Math.floor(Math.random()*ma_cho.length));

      m_copo[y]++;

    }

  }

  if (x==columns) clearInterval(ma_bod);

}



function zoomer(ycol) {

  var mtmp, mtem, ytmp;

  if (m_copo[ycol]==Math.floor(rows/2)+1) {

    for (ytmp=0; ytmp<rows; ytmp++) {

      if (w3c) {

        mtmp=document.getElementById("Mx"+ytmp+"y"+ycol);

        mtmp.firstChild.nodeValue=m_coch[ycol];

      }

      else {

        mtmp=document.all["Mx"+ytmp+"y"+ycol];

        mtmp.innerHTML=m_coch[ycol];

      }

      mtmp.style.color="#91060d";

      mtmp.style.fontWeight="bold";

    }

    if (Math.random()<reveal) {

      mtmp=ma_cho.indexOf(ma_txt.charAt(ycol));

      ma_cho=ma_cho.substring(0, mtmp)+ma_cho.substring(mtmp+1, ma_cho.length);

    }

    if (Math.random()<reveal-1) ma_cho=ma_cho.substring(0, ma_cho.length-1);

    m_copo[ycol]+=199;

    setTimeout("zoomer("+ycol+")", speed);

  }

  else if (m_copo[ycol]>200) {

    if (w3c) {

      mtmp=document.getElementById("Mx"+(m_copo[ycol]-201)+"y"+ycol);

      mtem=document.getElementById("Mx"+(200+rows-m_copo[ycol]--)+"y"+ycol);

    }

    else {

      mtmp=document.all["Mx"+(m_copo[ycol]-201)+"y"+ycol];

      mtem=document.all["Mx"+(200+rows-m_copo[ycol]--)+"y"+ycol];

    }

    mtmp.style.fontWeight="normal";

    mtem.style.fontWeight="normal";

    setTimeout("zoomer("+ycol+")", speed);

  }

  else if (m_copo[ycol]==200) m_copo[ycol]=100+Math.floor(rows/2);

  if (m_copo[ycol]>100 && m_copo[ycol]<200) {

    if (w3c) {

      mtmp=document.getElementById("Mx"+(m_copo[ycol]-101)+"y"+ycol);

      mtmp.firstChild.nodeValue=String.fromCharCode(160);

      mtem=document.getElementById("Mx"+(100+rows-m_copo[ycol]--)+"y"+ycol);

      mtem.firstChild.nodeValue=String.fromCharCode(160);

    }

    else {

      mtmp=document.all["Mx"+(m_copo[ycol]-101)+"y"+ycol];

      mtmp.innerHTML=String.fromCharCode(160);

      mtem=document.all["Mx"+(100+rows-m_copo[ycol]--)+"y"+ycol];

      mtem.innerHTML=String.fromCharCode(160);

    }

    setTimeout("zoomer("+ycol+")", speed);

  }

  

  //start

var h1 = document.getElementsByTagName("h1")[0],

text = h1.innerText || h1.textContent,

split = [], i, lit = 0, timer = null;

for(i = 0; i < text.length; ++i) {

split.push("<span>" + text[i] + "</span>");

}

h1.innerHTML = split.join("");

split = h1.childNodes;



var flicker = function() {

lit += 0.01;

if(lit >= 1) {

clearInterval(timer);

}

for(i = 0; i < split.length; ++i) {

if(Math.random() < lit) {

split[i].className = "neon";

} else {

split[i].className = "";

}

}

}
setInterval(flicker, 100);

}

</script>
<link rel="openid.server" href="http://www.blogger.com/openid-server.g" />
</head>
<center>
<body background='' oncontextmenu='return true;' onkeydown='return true;' onmousedown='return true;' lang=EN-US style='tab-interval:36.0pt; text-align:center' ><div style="position: fixed; top: 75px; left: -225px; width: 600px; padding: 10px; font-size: 24px; text-align: center; color: white; font-family: 'trebuchet ms', verdana, arial, sans-serif;transform: rotate(-45deg);transform-origin: 50% 0px;-o-transform: rotate(-45deg); -o-transform-origin: 50% 0px;-moz-transform: rotate(-45deg); -moz-transform-origin: 50% 0px; -webkit-transform: rotate(-45deg); -webkit-transform-origin: 50% 0px; background-color: Transparent; border: 1px solid rgb(170, 170, 170); z-index: 9999; opacity: 0.0;"></div>
<!-- <br> <br><h1>TCXS PROJECT HACKER TEAM</h1>
<div id="matrix" class="auto-style8">PAINEL ADMIN VERSAO 1.0</div>
<font face="courier new" color="Red" size"12" ></center> -->
<a href="cadastro.php?act=tcxs"> <button  class="btn btn-primary" /> VOLTAR AO CADASTRO</button></a>
<div class="container">
            <header class="row">
                <br />
            </header>
            <article>
                <div class="row">
                    <form action="?act=save" method="POST" name="form1" class="form-horizontal" >
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="panel-title">Sistema de consulta | Verificar Vazamentos | Insira Usuario.</span>
                            </div>
                            <div class="panel-body">


                                <div class="form-group">    
                                    <label for="usuario" class="col-sm-1 control-label">Usuario:</label>
                                    <div class="col-md-10">
                                        <input type="text" name="usuario" value="<?php
                                        echo (isset($usuario) && ($usuario != null || $usuario != "")) ? $usuario : '';
                                        ?>" class="form-control" />
                                        <p>Insira o nome de usuário (username) cadastrado, confira a lista de usuários na tela anterior. Ignore o erro abaixo, insira o nome de usuário e clique em verificar, será exibido todos os logins com data, hora, usuario, senha e o IP. Em caso de IP diferente consulte o usuário ou apenas volte a tela anterior e realize o banimento do mesmo. Usuários cadastrados neste sistema passam por uma verificação diária, seu banimento é automático.</p>
                                    </div>
                                </div>
                        </div>
                                



                            <div class="panel-footer">
                                <div class="clearfix">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary" /><span class="glyphicon glyphicon-ok"></span> verificar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ip</th>
                                    <th>usuario</th>
                                    <th>senha</th>
                                    <th>data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //trata o erro nao exibingo a mensagem de erro do mysql por nao achar uma database.
                                error_reporting(E_ALL & ~E_NOTICE);
                                /**
                                 *  Bloco que realiza o papel do Read - recupera os dados e apresenta na tela
                                 */
                                



                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM $usuario");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {

                                            ?><tr>
                                                <td><?php echo $rs->ip; ?></td>
                                                <td><?php echo $rs->usuario; ?></td>
                                                <td><?php echo $rs->senha; ?></td>
                                                <td><?php echo $rs->data_atual; ?></td>
                                                <td><center>
                                        </center>
                                        </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                }
                            } catch (PDOException $erro) {
                                

                                echo "Caso usuário ainda não tenha realizado o login não teremos dados para consultar, espere ate que o usuário logue e tente novamente!" ;
                            }

                            ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </article>
        </div>
        <!-- final do painel de consultas -->

  





<link href='http://fonts.googleapis.com/css?family=Iceland' rel='stylesheet' type='text/css'>
<span style='font: 15px Lucida Handwriting;size:15px;color:red;text-shadow: 0px 0px 50px;'><strong>
<style type="text/css">
<span style='font: 100px>
 body{
  font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif; 
  margin-top:0px;
   background-repeat:no-repeat;
  padding-top:26px;
 }
    #myContent, #myContent blink{
        width:0%px;
        height:0%px;
        background:black;
        color: #91060d;
        font-family:IceLand;
        font-size:20px;
    }    
    blink{
        display:inline;
    }
    </style><br />
    <script type="text/javascript">
  var charIndex = -1;
    var stringLength = 0;
    var inputText;
    function writeContent(init){
     if(init){
      inputText = document.getElementById('contentToWrite').innerHTML;
     }
        if(charIndex==-1){
            charIndex = 0;
            stringLength = inputText.length;
        }
        var initString = document.getElementById('myContent').innerHTML;
  initString = initString.replace(/<SPAN.*$/gi,"");
        
        var theChar = inputText.charAt(charIndex);
        var nextFourChars = inputText.substr(charIndex,4);
        if(nextFourChars=='<br>' || nextFourChars=='<br>'){
         theChar  = '<br>';
         charIndex+=3;
        }
        initString = initString + theChar + "<span id='blink'>_</SPAN>";
        document.getElementById('myContent').innerHTML = initString;

        charIndex = charIndex/1 +1;
  if(charIndex%2==1){
             document.getElementById('blink').style.display='font: 100px';
        }else{
             document.getElementById('blink').style.display='inline';
        }
                
        if(charIndex<=stringLength){
            setTimeout('writeContent(false)',100);
        }else{
         blinkSpan();
        }  
    }
        var currentStyle = 'inline';
    function blinkSpan(){
     if(currentStyle=='inline'){
      currentStyle='none';
     }else{
      currentStyle='inline';
     }
     document.getElementById('blink').style.display = currentStyle;
     setTimeout('blinkSpan()',9999999);
     
    }

   <img src="http://kodbul.org/img/konuayirac/kurukafa.gif" border="0">
<div style="display: none;">

</div>tsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script></body>
</html>
<font color="#91060d"><footer id="det" style="position:fixed; left:0px; right:0px; bottom:0px; background:rgb(0,0,0); text-align:center; border-top: 1px solid #91060d; border-bottom: 1px solid #91060d"><font color="#91060d" face="Tahoma" size="2"><font color="91060d"><b> TCXS Project 2020</b></font>

 

